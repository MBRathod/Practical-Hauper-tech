<?php

namespace App\Console\Commands;

use App\Models\Reminders;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:user-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail to User Schedule Time';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try{
            $remainders = Reminders::where('schedule_date_time', date('Y-m-d H:i',strtotime(Carbon::now())))->get();
            
            $users = User::get();
            if($remainders){
                foreach ($remainders as $remainder){
                    foreach($users as $user)
                    {
                        $info = array(
                            'name' => $user->name,
                            'description' => $remainder->description,
                            'title' => $remainder->title
                        );
                        Mail::send('admin.mail', $info, function($message) use ($user,$remainder) {
                            $message->to($user->email)->subject
                               ($remainder->title);
                         });
                       
                    }
                    Log::info('Mail Sent');
                   
                }
            }else{
                Log::info('Data Not Found');
            }
           
        }catch(Exception $e){
            Log::info('Error '.$e->getMessage());
        }
      
    }
}
