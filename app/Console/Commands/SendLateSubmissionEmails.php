<?php

namespace App\Console\Commands;

use App\Mail\LateSubmitEmailDigest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendLateSubmissionEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'latesubmit:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to users who has not return book in time';

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
           //get all user_id who has not sumbit book in time.
           $reminders = DB::table('book_user')->where('return_date','<',now()->format('Y-m-d'))
           ->orderby('user_id')
           ->get();

       foreach ($reminders as $reminder) {
           
           $this->sendEmailToUser($reminder->user_id);
     }
    }

    public function sendEmailToUser($user_id){
        $user=User::find($user_id);
         Mail::to($user)->send(new LateSubmitEmailDigest());
    }

}
