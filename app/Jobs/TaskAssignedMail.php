<?php

namespace App\Jobs;

use App\Mail\TaskAssigned;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class TaskAssignedMail implements ShouldQueue
{
    use Queueable;
    protected $user;
    protected $datas;


    /**
     * Create a new job instance.
     */
    public function __construct($datas)
    {
        $this->datas = $datas;
        $this->user = User::find($datas['userId']);
        $this->datas['user'] = $this->user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new TaskAssigned($this->datas));
    }
}
