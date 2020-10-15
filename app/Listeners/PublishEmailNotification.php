<?php

namespace App\Listeners;

use App\Events\PublishMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\User;
use App\Mail\CreateBlogMail;
use App\Mail\EditorMail;
use App\Mail\PublishMail;
class PublishEmailNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PublishMailEvent  $event
     * @return void
     */
    public function handle(PublishMailEvent $event)
    {
        $userid=$event->blog->user_id;
        $email=User::where('id',$event->blog->user_id)->pluck('email');
        
        Mail::to($email)->send(new PublishMail($event->blog));
       
    }

     
}
