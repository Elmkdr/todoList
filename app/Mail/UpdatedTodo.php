<?php
namespace App\Mail;

use App\Models\todo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdatedTodo extends Mailable
{
    use Queueable, SerializesModels;

    public $todo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('todo Updated')
                    ->view('mail.todoUpdated');
    }
}
