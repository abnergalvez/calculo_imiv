<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Project;
use App\Models\Weekend;
use App\Models\Holiday;
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
        $ahora = Carbon::now()->timezone('America/Santiago');
        $this->info('Fecha/hora Actual:'. $ahora);
        
        if( !Weekend::isWeekendDate($ahora->toDateString()) &&  !Holiday::isHolidayDate($ahora->toDateString())){

            $projectsSoonExpired = $projects->filter(function ($value) {
                $ahora = Carbon::today();
                $limite = Carbon::parse($value->re_entry_date);
                if( $limite >= $ahora && $ahora->diffInDays($limite) <= 3 ){ 
                    if( isset($value->re_entry_date) && isset($value->limit_re_entry_date)){
                        if( $value->status == NULL || $value->status == 'in_budget' || 
                            $value->status == 'registered_for_observation' || 
                            $value->status == 'in_correction' ){
                                return $value; 
                        }
                    }
                }
            });

            $this->info(count($projectsSoonExpired). ' to expired re-entry in 3 days');

            if(count($projectsSoonExpired) > 0 ){
                
                $this->info('Sending email alerts to admin users...');
                $user_super = User::where('profile','admin')->where('super',1)->first();

                foreach ($projectsSoonExpired as $project) {
                    $userProyect = User::where('id', $project->engineer_user_id)->first();
                    Mail::to($user_super->email)->send(new AdminSendNearExpiredProjects( $user_super,$project));
                    Mail::to($userProyect->email)->send(new AdminSendNearExpiredProjects( $userProyect,$project));
                }
            }

        }else{
            $this->info('not send mail because is a Weekend or Holiday...'); 
        }

    }

}
