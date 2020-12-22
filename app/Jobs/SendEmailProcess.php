<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable; 
use Mail;

class SendEmailProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;

    protected $name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payment, $name)
    {
        $this->queue = 'default';
        $this->connection = 'database';
        $this->payment = $payment;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('client.layouts.bill', [
            'payment' => $this->payment,
        ], function($mail) {
            $mail->to(config('app.mail_test'), $this->name);
            $mail->subject('Booking Tour Details');
        });
    }
}
