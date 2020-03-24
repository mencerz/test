<?php

namespace App\Mail;

use App\ClientRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailForClientRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected $clientRequest;

    /**
     * Create a new message instance.
     *
     * @param ClientRequest $clientRequest
     */
    public function __construct(ClientRequest $clientRequest)
    {
        $this->clientRequest = $clientRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('3508197a50-d8441b@inbox.mailtrap.io')
            ->view('mail.client', [
                'clientRequest' => $this->clientRequest
            ]);
    }
}
