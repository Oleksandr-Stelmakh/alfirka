<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function store(
        StoreOrderRequest $request
    ): RedirectResponse {

        $validated = $request->validated();

        // Пока просто проверяем, что данные дошли.
        // Telegram и Email подключим следующим этапом.
        logger()->info('NEW ORDER', $validated);

        return back()->with(
            'success',
            'Ваше замовлення успішно відправлено!'
        );
    }
}