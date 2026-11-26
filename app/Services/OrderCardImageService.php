<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class OrderCardImageService
{
    private int $width = 1200;

    private int $padding = 48;

    private string $regularFont;
    private string $boldFont;

    public function __construct()
    {
        $this->regularFont = resource_path('Fonts/DejaVuSans.ttf');
        $this->boldFont = resource_path('Fonts/DejaVuSans-Bold.ttf');
    }

    /**
     * Створює зображення з повною інформацією про замовлення.
     * Повертає шлях до готового JPEG-файлу.
     */
    public function create(array $order): string
    {
        if (!extension_loaded('gd') || !function_exists('imagettftext')) {
            throw new RuntimeException(
                'Для створення картки замовлення необхідні GD та FreeType.'
            );
        }

        if (!is_file($this->regularFont) || !is_file($this->boldFont)) {
            throw new RuntimeException(
                'Не знайдено файли шрифтів DejaVuSans.'
            );
        }

        $items = $order['items'] ?? [];

        if (count($items) === 0) {
            throw new RuntimeException('У замовленні немає товарів.');
        }

        // Висота картки залежить від кількості товарів.
        $headerHeight = 190;
        $itemHeight = 245;
        $footerHeight = 420;

        $height = $headerHeight
            + (count($items) * $itemHeight)
            + $footerHeight;

        $image = imagecreatetruecolor($this->width, $height);

        if (!$image) {
            throw new RuntimeException(
                'Не вдалося створити зображення картки.'
            );
        }

        // Кольори картки.
        $background = imagecolorallocate($image, 250, 247, 245);
        $white = imagecolorallocate($image, 255, 255, 255);
        $dark = imagecolorallocate($image, 65, 48, 54);
        $muted = imagecolorallocate($image, 133, 115, 121);
        $accent = imagecolorallocate($image, 174, 91, 119);
        $line = imagecolorallocate($image, 235, 224, 226);
        $soft = imagecolorallocate($image, 246, 235, 239);

        imagefill($image, 0, 0, $background);

        try {
            // Заголовок картки.
            $this->drawText(
                $image,
                'НОВЕ ЗАМОВЛЕННЯ',
                $this->padding,
                75,
                34,
                $this->boldFont,
                $accent
            );

            $this->drawText(
                $image,
                'Замовлення №' . ($order['order_id'] ?? '—'),
                $this->padding,
                125,
                25,
                $this->regularFont,
                $dark
            );

            $this->drawText(
                $image,
                'Дата: ' . ($order['date_time'] ?? '—'),
                $this->width - 430,
                125,
                20,
                $this->regularFont,
                $muted
            );

            imageline(
                $image,
                $this->padding,
                160,
                $this->width - $this->padding,
                160,
                $line
            );

            // Товари в замовленні.
            $top = $headerHeight;

            foreach ($items as $index => $item) {
                $this->drawItem(
                    $image,
                    $item,
                    $index + 1,
                    $top,
                    $itemHeight,
                    $white,
                    $dark,
                    $muted,
                    $accent,
                    $line,
                    $soft
                );

                $top += $itemHeight;
            }

            // Нижня частина картки.
            $this->drawFooter(
                $image,
                $order,
                $top + 12,
                $white,
                $dark,
                $muted,
                $accent,
                $soft
            );

            $directory = storage_path('app/temp/order-cards');

            File::ensureDirectoryExists($directory);

            $filePath = $directory
                . DIRECTORY_SEPARATOR
                . 'order-' . ($order['order_id'] ?? uniqid()) . '-' . uniqid()
                . '.jpg';

            if (!imagejpeg($image, $filePath, 88)) {
                throw new RuntimeException(
                    'Не вдалося зберегти картку замовлення.'
                );
            }

            return $filePath;
        } finally {
            imagedestroy($image);
        }
    }

    /**
     * Малює одну позицію замовлення.
     */
    private function drawItem(
        $image,
        array $item,
        int $number,
        int $top,
        int $height,
        int $white,
        int $dark,
        int $muted,
        int $accent,
        int $line,
        int $soft
    ): void {
        $left = $this->padding;
        $right = $this->width - $this->padding;

        imagefilledrectangle(
            $image,
            $left,
            $top + 8,
            $right,
            $top + $height - 12,
            $white
        );

        // Фотографія товару.
        $photoX = $left + 18;
        $photoY = $top + 25;
        $photoWidth = 220;
        $photoHeight = 175;

        $this->drawProductPhoto(
            $image,
            $item['image_path'] ?? null,
            $photoX,
            $photoY,
            $photoWidth,
            $photoHeight,
            $soft,
            $muted
        );

        // Опис товару.
        $textX = $photoX + $photoWidth + 30;

        $title = $number . '. ' . ($item['product_title'] ?? 'Товар');

        $this->drawWrappedText(
            $image,
            $title,
            $textX,
            $top + 53,
            25,
            $this->boldFont,
            $dark,
            650,
            2
        );

        $this->drawText(
            $image,
            'Варіант: ' . ($item['variant_name'] ?? '—'),
            $textX,
            $top + 105,
            19,
            $this->regularFont,
            $muted
        );

        if (!empty($item['box_size'])) {
            $this->drawText(
                $image,
                'Коробка: ' . $item['box_size'],
                $textX,
                $top + 140,
                19,
                $this->regularFont,
                $muted
            );
        }

        if (!empty($item['flowers_count'])) {
            $this->drawText(
                $image,
                'Кількість квітів: ' . $item['flowers_count'],
                $textX,
                $top + 170,
                19,
                $this->regularFont,
                $muted
            );
        }

        $quantity = (int) ($item['quantity'] ?? 1);
        $unitPrice = (int) ($item['unit_price'] ?? 0);
        $totalPrice = (int) (
            $item['total_price'] ?? ($quantity * $unitPrice)
        );

        $this->drawText(
            $image,
            'Кількість: ' . $quantity . ' шт.',
            $textX,
            $top + 210,
            19,
            $this->regularFont,
            $dark
        );

        $this->drawText(
            $image,
            number_format($unitPrice, 0, ',', ' ')
                . ' грн × ' . $quantity
                . ' = '
                . number_format($totalPrice, 0, ',', ' ')
                . ' грн',
            $right - 370,
            $top + 210,
            19,
            $this->boldFont,
            $accent
        );

        imageline(
            $image,
            $left + 18,
            $top + $height - 1,
            $right - 18,
            $top + $height - 1,
            $line
        );
    }

    /**
     * Малює фотографію з обрізанням під розмір області.
     */
    private function drawProductPhoto(
        $canvas,
        ?string $imagePath,
        int $x,
        int $y,
        int $width,
        int $height,
        int $background,
        int $muted
    ): void {
        imagefilledrectangle(
            $canvas,
            $x,
            $y,
            $x + $width,
            $y + $height,
            $background
        );

        if (!$imagePath) {
            $this->drawText(
                $canvas,
                'Немає фото',
                $x + 65,
                $y + 95,
                20,
                $this->regularFont,
                $muted
            );

            return;
        }

        $path = Storage::disk('public')->path($imagePath);

        if (!is_file($path)) {
            $this->drawText(
                $canvas,
                'Фото не знайдено',
                $x + 25,
                $y + 95,
                17,
                $this->regularFont,
                $muted
            );

            return;
        }

        $contents = @file_get_contents($path);

        if ($contents === false) {
            return;
        }

        $source = @imagecreatefromstring($contents);

        if (!$source) {
            return;
        }

        try {
            $sourceWidth = imagesx($source);
            $sourceHeight = imagesy($source);

            if ($sourceWidth <= 0 || $sourceHeight <= 0) {
                return;
            }

            $scale = max(
                $width / $sourceWidth,
                $height / $sourceHeight
            );

            $cropWidth = (int) round($width / $scale);
            $cropHeight = (int) round($height / $scale);

            $sourceX = (int) (($sourceWidth - $cropWidth) / 2);
            $sourceY = (int) (($sourceHeight - $cropHeight) / 2);

            imagecopyresampled(
                $canvas,
                $source,
                $x,
                $y,
                $sourceX,
                $sourceY,
                $width,
                $height,
                $cropWidth,
                $cropHeight
            );
        } finally {
            imagedestroy($source);
        }
    }

    /**
     * Малює нижню частину: покупець, коментар та підсумок.
     */
    private function drawFooter(
        $image,
        array $order,
        int $top,
        int $white,
        int $dark,
        int $muted,
        int $accent,
        int $soft
    ): void {
        $left = $this->padding;
        $right = $this->width - $this->padding;

        imagefilledrectangle(
            $image,
            $left,
            $top,
            $right,
            $top + 300,
            $white
        );

        $x = $left + 24;
        $y = $top + 42;

        $this->drawText(
            $image,
            'ДАНІ ПОКУПЦЯ',
            $x,
            $y,
            21,
            $this->boldFont,
            $accent
        );

        $y += 42;

        $this->drawText(
            $image,
            'Ім’я: ' . ($order['name'] ?? '—'),
            $x,
            $y,
            19,
            $this->regularFont,
            $dark
        );

        $y += 34;

        $this->drawText(
            $image,
            'Телефон: ' . ($order['phone'] ?? '—'),
            $x,
            $y,
            19,
            $this->regularFont,
            $dark
        );

        $y += 34;

        $this->drawText(
            $image,
            'Електронна пошта: ' . ($order['email'] ?? '—'),
            $x,
            $y,
            19,
            $this->regularFont,
            $dark
        );

        $y += 42;

        $this->drawText(
            $image,
            'Коментар:',
            $x,
            $y,
            18,
            $this->boldFont,
            $muted
        );

        $this->drawWrappedText(
            $image,
            $order['comment'] ?: 'Не вказано',
            $x + 155,
            $y,
            18,
            $this->regularFont,
            $dark,
            760,
            2
        );

        // Загальна сума замовлення.
        $total = number_format(
            (float) ($order['total_price'] ?? 0),
            0,
            ',',
            ' '
        );

        imagefilledrectangle(
            $image,
            $left,
            $top + 315,
            $right,
            $top + 390,
            $soft
        );

        $this->drawText(
            $image,
            'РАЗОМ ДО СПЛАТИ',
            $x,
            $top + 360,
            22,
            $this->boldFont,
            $dark
        );

        $this->drawText(
            $image,
            $total . ' грн',
            $right - 300,
            $top + 365,
            30,
            $this->boldFont,
            $accent
        );
    }

    /**
     * Малює один рядок тексту.
     */
    private function drawText(
        $image,
        string $text,
        int $x,
        int $y,
        int $size,
        string $font,
        int $color
    ): void {
        imagettftext(
            $image,
            $size,
            0,
            $x,
            $y,
            $color,
            $font,
            $text
        );
    }

    /**
     * Переносить довгий текст на декілька рядків.
     */
    private function drawWrappedText(
        $image,
        string $text,
        int $x,
        int $y,
        int $size,
        string $font,
        int $color,
        int $maxWidth,
        int $maxLines = 2
    ): void {
        $words = preg_split('/\s+/u', trim($text)) ?: [];
        $lines = [];
        $currentLine = '';

        foreach ($words as $word) {
            $testLine = $currentLine === ''
                ? $word
                : $currentLine . ' ' . $word;

            $box = imagettfbbox($size, 0, $font, $testLine);
            $lineWidth = abs($box[2] - $box[0]);

            if ($lineWidth > $maxWidth && $currentLine !== '') {
                $lines[] = $currentLine;
                $currentLine = $word;
            } else {
                $currentLine = $testLine;
            }
        }

        if ($currentLine !== '') {
            $lines[] = $currentLine;
        }

        if (count($lines) > $maxLines) {
            $lines = array_slice($lines, 0, $maxLines);
            $lastIndex = count($lines) - 1;
            $lines[$lastIndex] = rtrim($lines[$lastIndex], " .") . '…';
        }

        foreach ($lines as $line) {
            $this->drawText(
                $image,
                $line,
                $x,
                $y,
                $size,
                $font,
                $color
            );

            $y += $size + 10;
        }
    }
}
