<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use App\Models\User;
use Mail;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send email to the admin and prompt them to check unapproved bookings';

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
     * @return mixed
     */
    public function handle()
    {
        $user = User::where('role', config('app.admin_role'))->first();
        $unPaidPayments = Payment::with('booktour.user', 'booktour.booktourdetails.tour')->where('payment_status', config('app.unpaid'))->get();
        Mail::send('admin.pages.unpaidpayment', [
            'unPaidPayments' => $unPaidPayments,
        ], function($mail) use ($user){
            $mail->to('hoangthaonampk2407@gmail.com', $user->name);
            $mail->subject('Booking Tour Details');
        });
        $this->line('Complete');
    }
}
