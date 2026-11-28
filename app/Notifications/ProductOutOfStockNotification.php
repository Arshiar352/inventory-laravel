<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProductOutOfStockNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $productName
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'اتمام موجودی محصول',
            'message' => "موجودی محصول {$this->productName} به پایان رسیده است.",
        ];
    }
}
