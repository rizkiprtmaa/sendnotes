<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;


class SendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Note $note)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl = config('app.url') . '/notes/' . $this->note->id;

        $emailContent = "Hello
            You have a new note to read. 
            Click the link below to read the note:
            {$noteUrl}";

            Mail::raw($emailContent, function ($message) {
                $message->from('sendnotes@ky.com', 'Sendnotes')->to($this->note->recepient)->subject('You have a New Note from ' . $this->note->user->name);
            });
    }
}
