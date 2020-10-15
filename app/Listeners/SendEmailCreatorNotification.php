<?php

namespace App\Listeners;

use App\Events\CreateBlogMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\User;
use App\Mail\CreateBlogMail;
use App\Mail\EditorMail;
class SendEmailCreatorNotification implements ShouldQueue
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
     * @param  CreateBlogMailEvent  $event
     * @return void
     */
    public function handle(CreateBlogMailEvent $event)
    {
        $userid=$event->blog->user_id;
        $email=User::where('id',$event->blog->user_id)->pluck('email');
        
        Mail::to($email)->send(new CreateBlogMail($event->blog));
        Mail::to('editor@mail.com')->send(new EditorMail($event->blog));       
    }
}
