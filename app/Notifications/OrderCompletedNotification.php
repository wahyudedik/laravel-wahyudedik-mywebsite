<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCompletedNotification extends Notification implements ShouldQueue
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $downloadUrl = route('orders.status', $this->order->order_number);
        
        return (new MailMessage)
            ->subject('Your Order is Ready for Download - ' . $this->order->product->name)
            ->greeting('Hello ' . $this->order->name . '!')
            ->line('Great news! Your order has been processed and is now ready for download.')
            ->line('Order Number: ' . $this->order->order_number)
            ->line('Product: ' . $this->order->product->name)
            ->line('License Type: ' . ucfirst($this->order->license_type))
            ->action('Download Your Product', $downloadUrl)
            ->line('The download link will be available for 7 days.')
            ->line('Thank you for your purchase!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
