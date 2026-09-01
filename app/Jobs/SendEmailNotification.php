<?php

namespace App\Jobs;

use App\Mail\OrderCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendEmailNotification implements ShouldQueue
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

   public function handle(): void
   {
      if (!config('services.mail.notifications_enabled')) {
         return;
      }

      Mail::to(
         config('mail.from.address')
      )->send(
         new OrderCreatedMail($this->order)
      );
   }

   public function failed(Throwable $exception): void
   {
      Log::error('Email notification permanently failed', [
         'order_id' => $this->order['order_id'] ?? null,
         'error' => $exception->getMessage(),
      ]);
   }
}