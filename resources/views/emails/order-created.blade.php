
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нове замовлення — Alfirka</title>
</head>

<body style="margin:0; padding:24px 10px; background-color:#f7f3f0; font-family:Arial, sans-serif; color:#39312e;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">

                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="max-width:680px; background:#ffffff; border-radius:16px; overflow:hidden;">

                    <!-- Заголовок -->
                    <tr>
                        <td style="padding:30px 24px; background:#f1e6e0; text-align:center;">
                            <h1 style="margin:0; font-size:25px; color:#60483f;">
                                🌸 Alfirka
                            </h1>

                            <p style="margin:12px 0 0; font-size:20px; font-weight:bold;">
                                Нове замовлення №{{ $order['order_id'] }}
                            </p>

                            <p style="margin:8px 0 0; color:#806e65; font-size:14px;">
                                {{ $order['date_time'] ?? '' }}
                            </p>
                        </td>
                    </tr>

                    <!-- Контактні дані -->
                    <tr>
                        <td style="padding:25px 24px 10px;">
                            <h2 style="margin:0 0 16px; font-size:19px;">
                                Контактні дані
                            </h2>

                            <p style="margin:8px 0;">
                                <strong>Ім’я:</strong>
                                {{ $order['name'] }}
                            </p>

                            <p style="margin:8px 0;">
                                <strong>Телефон:</strong>
                                <a href="tel:{{ $order['phone'] }}" style="color:#936b5c;">
                                    {{ $order['phone'] }}
                                </a>
                            </p>

                            <p style="margin:8px 0;">
                                <strong>Email:</strong>
                                <a href="mailto:{{ $order['email'] }}" style="color:#936b5c;">
                                    {{ $order['email'] }}
                                </a>
                            </p>
                        </td>
                    </tr>

                    <!-- Состав заказа -->
                    <tr>
                        <td style="padding:15px 24px 10px;">
                            <h2 style="margin:0 0 18px; font-size:19px;">
                                Склад замовлення
                            </h2>

                            @foreach ($order['items'] as $index => $item)

                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                                       style="margin-bottom:18px; border:1px solid #eadfd8; border-radius:12px; overflow:hidden;">

                                    <tr>
                                        <td style="padding:16px;">

                                            <p style="margin:0 0 14px; font-size:16px; font-weight:bold; color:#60483f;">
                                                {{ $index + 1 }}. {{ $item['product_title'] }}
                                            </p>

                                            @if (!empty($item['image_path']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($item['image_path']))
                                                <div style="margin-bottom:15px;">
                                                    <img
                                                        src="{{ $message->embed(\Illuminate\Support\Facades\Storage::disk('public')->path($item['image_path'])) }}"
                                                        alt="{{ $item['product_title'] }}"
                                                        width="220"
                                                        style="display:block; width:220px; max-width:100%; height:auto; border-radius:10px;"
                                                    >
                                                </div>
                                            @endif

                                            <p style="margin:7px 0;">
                                                <strong>Варіант:</strong>
                                                {{ $item['variant_name'] }}
                                            </p>

                                            @if (!empty($item['box_size']))
                                                <p style="margin:7px 0;">
                                                    <strong>Розмір коробки:</strong>
                                                    {{ $item['box_size'] }}
                                                </p>
                                            @endif

                                            @if (!empty($item['flowers_count']))
                                                <p style="margin:7px 0;">
                                                    <strong>Кількість квітів:</strong>
                                                    {{ $item['flowers_count'] }}
                                                </p>
                                            @endif

                                            <p style="margin:7px 0;">
                                                <strong>Кількість:</strong>
                                                {{ $item['quantity'] }} шт.
                                            </p>

                                            <p style="margin:7px 0;">
                                                <strong>Ціна за одиницю:</strong>
                                                {{ number_format($item['unit_price'], 0, ',', ' ') }} грн
                                            </p>

                                            <p style="margin:12px 0 0; padding-top:12px; border-top:1px solid #eee3dd; font-size:16px;">
                                                <strong>Сума позиції:</strong>
                                                <strong style="color:#936b5c;">
                                                    {{ number_format($item['total_price'], 0, ',', ' ') }} грн
                                                </strong>
                                            </p>

                                        </td>
                                    </tr>
                                </table>

                            @endforeach
                        </td>
                    </tr>

                    <!-- Комментарий -->
                    <tr>
                        <td style="padding:10px 24px 20px;">
                            <h2 style="margin:0 0 10px; font-size:18px;">
                                Коментар покупця
                            </h2>

                            <p style="margin:0; padding:14px; background:#faf7f5; border-radius:10px; white-space:pre-line;">
                                {{ $order['comment'] ?: 'Не вказано' }}
                            </p>
                        </td>
                    </tr>

                    <!-- Итог -->
                    <tr>
                        <td style="padding:22px 24px; background:#f1e6e0; text-align:center;">
                            <p style="margin:0 0 8px; font-size:15px; color:#806e65;">
                                РАЗОМ ДО СПЛАТИ
                            </p>

                            <p style="margin:0; font-size:28px; font-weight:bold; color:#60483f;">
                                {{ number_format($order['total_price'], 0, ',', ' ') }} грн
                            </p>
                        </td>
                    </tr>

                    <!-- Подвал -->
                    <tr>
                        <td style="padding:20px; text-align:center; color:#9b8980; font-size:12px;">
                            Alfirka — квіти, створені з любов’ю 🌸
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
