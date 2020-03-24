<?php

namespace App\Jobs;

use App\ClientRequest;
use App\Mail\MailForClientRequest;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ClientRequest
     */
    protected $clientRequest;

    /**
     * Create a new job instance.
     *
     * @param ClientRequest $clientRequest
     */
    public function __construct(ClientRequest $clientRequest)
    {
        $this->clientRequest = $clientRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $manager = User::role(User::ROLE_MANAGER)->firstOrFail();
        Mail::to($manager->email)->send(new MailForClientRequest($this->clientRequest));
    }
}
