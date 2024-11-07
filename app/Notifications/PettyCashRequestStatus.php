<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class PettyCashRequestStatus extends Notification
{
    use Queueable;

    protected $requests;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($request, $status)
    {
        $this->requests = $request;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
        return [
    'request_id'=> $this->request->id,
    'amount'=> $this->request->amount,
    'reason'=> $this->request->reason,
    'status'=> $this->status,
    ];

    }

}
