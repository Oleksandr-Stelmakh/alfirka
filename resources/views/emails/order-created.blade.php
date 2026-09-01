<!DOCTYPE html>
<html lang="uk">
   <head>
       <meta charset="UTF-8">

       <title>Нове замовлення — Alfirka</title>
   </head>

   <body>

      <h1>🌸 Нове замовлення!</h1>

      <p>
      <strong>📅 Дата та час:</strong> {{ $order['date_time'] }}
      </p>
      <hr>

      <p>
         <strong>👤 Ім'я:</strong><br>
         {{ $order['name'] }}
      </p>

      <p>
         <strong>📞 Телефон:</strong><br>

         <a href="tel:{{ preg_replace('/\D+/', '', $order['phone']) }}">
            {{ $order['phone'] }}
         </a>
      </p>

      <p>
         <strong>📧 Email:</strong><br>
         {{ $order['email'] }}
      </p>

      <hr>

      <p>
         <strong>💐 Букет:</strong><br>
         {{ $order['bouquet_title'] }}
      </p>

      <p>
         <strong>📦 Розмір:</strong><br>
         {{ $order['size'] }}
      </p>

      <p>
         <strong>💰 Ціна:</strong><br>
         {{ $order['price'] }} грн
      </p>

      <hr>

      <p>
         <strong>💬 Коментар:</strong><br>

         {{ $order['comment'] ?: 'Не вказано' }}
      </p>

   </body>
</html>