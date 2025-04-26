<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Order: ' . $this->order->order_number)
                    ->line('A new order has been placed.')
                    ->line('Order Number: ' . $this->order->order_number)
                    ->line('Product: ' . $this->order->product->name)
                    ->line('License: ' . ucfirst($this->order->license_type))
                    ->line('Amount: $' . number_format($this->order->amount, 2))
                    ->action('View Order', url(route('admin.orders.show', $this->order->id)))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'name' => $this->order->name,
            'product' => $this->order->product->name,
            'amount' => $this->order->amount,
            'message' => 'New order placed: ' . $this->order->product->name,
        ];
    }
}
