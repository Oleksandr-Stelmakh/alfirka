<?php

namespace App\Jobs;

use App\Services\TelegramService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendTelegramNotification implements ShouldQueue
{
   use Queueable;

   public int $tries = 3;

   public function backoff(): array
   {
      return [10, 60, 300];
   }

   public function __construct(
      public array $order
   ) {
   }

   public function handle(
      TelegramService $telegram
   ): void {

      if (!config('services.telegram.notifications_enabled')) {
         return;
      }

      $telegram->sendOrderNotification($this->order);
   }

   public function failed(Throwable $exception): void
   {
      Log::error('Telegram notification permanently failed', [
         'order_id' => $this->order['order_id'] ?? null,
         'error' => $exception->getMessage(),
      ]);
   }
}