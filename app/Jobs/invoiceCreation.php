<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\invoiceEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Config;



class invoiceCreation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    public $subject;
    public $to_email;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($data, $subject, $to_email)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->to_email = $to_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      //  $email = new invoiceEmail($this->data, $this->subject);
        Mail::to($this->to_email)->send(new invoiceEmail($this->data, $this->subject));
    }
}
