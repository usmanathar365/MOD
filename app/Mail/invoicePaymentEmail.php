<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invoicePaymentEmail extends Mailable 
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    protected $data;
    public $subject;

    public function __construct($data, $subject)
    {
        $this->data = $data;
        $this->subject = $subject;
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('admin.emailTemplates.invoice_payment')->with([
            'data' => $this->data,
            'subject' => $this->subject
        ]);
    }
}
