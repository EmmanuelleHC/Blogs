<?php

namespace App\Mail;
use App\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
class CreateBlogMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $blog,$name,$email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Blog $blog)
    {
        $this->blog=$blog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name=User::where('id',$this->blog->user_id)->value('name');

        return $this->from('mail_server@mail.com')->view('create_blog_notification')->with(['nama'=>$name,'judul'=>$this->blog->title]);

    }
}
