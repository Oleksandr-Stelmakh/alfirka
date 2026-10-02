<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="manifest" href="/site.webmanifest"> -->

    @php
    $isAdmin = request()->is('admin*');
@endphp

@if ($isAdmin)
    <link rel="icon" type="image/x-icon" href="/icons/admin/favicon.ico">
    <link rel="apple-touch-icon" href="/icons/admin/apple-touch-icon.png">
    <link rel="manifest" href="/admin.webmanifest">
    <meta name="theme-color" content="#7b2cbf">
@else
    <link rel="icon" type="image/x-icon" href="/icons/alfirka/favicon.ico">
    <link rel="apple-touch-icon" href="/icons/alfirka/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#ffe0e8">
@endif

     <!-- Open Graph -->
    <meta property="og:title" content="Alfirka" />
    <meta property="og:description" content="Зефірні букети ручної роботи та ароматна кава — створюємо солодкі моменти для особливих людей." />
    <meta property="og:image" content="/og-image.webp" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://alfirka.org" />
    <!-- <meta property="og:image" content="https://alfirka.org/og-image.heic" /> -->

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Alfirka" />
    <meta name="twitter:description" content="Зефірні букети ручної роботи та ароматна кава — створюємо солодкі моменти для особливих людей." />
    <meta name="twitter:image" content="/og-image.webp" />
    <!-- <meta name="twitter:image" content="https://alfirka.org/og-image.heic" /> -->

    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body>
    @inertia
</body>
</html>