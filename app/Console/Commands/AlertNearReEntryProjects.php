<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminSendNearExpiredProjects;

class AlertNearReEntryProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'useremail:alert-near-reentry-project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send alert emails to admin users when three days left for limit re-entry project';

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
        $projects = Project::all();
        $projectSoonExpired = $projects->filter(function ($value, $key) {
            $ahora = Carbon::today();
            $limite = Carbon::parse($value->limit_re_entry_date);
            if($limite >= $ahora && $ahora->diffInDays($limite) <= 3 && !isset($value->re_entry_date)){
                return $value; 
            }
        });

        $this->info(count($projectSoonExpired). ' to expired re-entry in 3 days');

        if(count($projectSoonExpired) > 0 ){
            
            $this->info('Sending email alerts to admin users...');

            $users = User::where('profile','admin')->get();
            foreach ($users as $admin) {
                Mail::to($admin->email)
                    ->send(new AdminSendNearExpiredProjects( $admin,$projectSoonExpired));
            }
        }
    }
}
