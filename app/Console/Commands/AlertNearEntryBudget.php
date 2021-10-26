<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminSendNearExpiredBudgets;

use Illuminate\Console\Command;

class AlertNearEntryBudget extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'useremail:alert-near-entry-budget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send alert emails to super admin users when three days left for limit entry budget';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $budgets = Budget::all();
        $budgetEntrySoonExpired = $budgets->filter(function ($value, $key) {
            $ahora = Carbon::today();
            $limite = Carbon::parse($value->limit_entry_date);
            if($limite >= $ahora && $ahora->diffInDays($limite) <= 3 && !isset($value->entry_date)){
                return $value; 
            }
        });

        $this->info(count($budgetEntrySoonExpired). ' budgets to expired in 3 days');

        if(count($budgetEntrySoonExpired) > 0 ){
            
            $this->info('Sending email alerts to super admin users...');

            $users = User::where('profile','admin')->where('super',1)->get();
            foreach ($users as $admin) {
                Mail::to($admin->email)
                    ->send(new AdminSendNearExpiredBudgets( $admin,$budgetEntrySoonExpired));
            }
        }
    }
}
