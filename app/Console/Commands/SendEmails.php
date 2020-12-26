<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Internships;
use App\Classes\Email;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send a mail to users with suggestions';

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
        $users = User::all();
        $mail = new Email();

        foreach ($users as $user) {
            if ($user->account_type == 1) {
                //get internship in the city of student that was recently added
                $internship = Internships::where('city', 'LIKE', $user->city)
                    ->where('active', 1)
                    ->orderBy('id', 'DESC')
                    ->first();
                //send mail
                $mail->sendgrid($user->email, $internship);
            }
        }
    }
}
