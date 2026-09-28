<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class BouquetsSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::updateOrCreate(
            ['slug' => 'marshmallow-bouquets'],
            [
                'name' => 'Зефірні букети',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $bouquets = [
            [
                'slug' => 'flower-tenderness',
                'title' => 'Квіткова ніжність',
                'description' => 'Ніжний букет із натурального зефіру ручної роботи',
                'badge' => 'Новинка',
                'image' => 'img-1.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 900,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                        ],
                    ],
                ],
            ],

            [
                'slug' => 'strawberry-morning',
                'title' => 'Полуничний ранок',
                'description' => 'Легка композиція у ніжних рожевих відтінках',
                'badge' => 'Акція',
                'image' => 'img-2.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 990,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                            'img-2.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                            'img-2.webp',
                            'img-6.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                            'img-2.webp',
                            'img-8.webp',
                            'img-5.webp',
                        ],
                    ],
                ],
            ],

            [
                'slug' => 'sweet-love',
                'title' => 'Солодке кохання',
                'description' => 'Ідеальний подарунок для особливого дня',
                'badge' => 'Хіт',
                'image' => 'img-3.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 1190,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                        ],
                    ],
                ],
            ],

            [
                'slug' => 'berry-dream',
                'title' => 'Ягідна мрія',
                'description' => 'Яскравий букет із полуничними нотками',
                'badge' => '-15%',
                'image' => 'img-4.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 1490,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                        ],
                    ],
                ],
            ],

            [
                'slug' => 'pink-cloud',
                'title' => 'Рожева хмаринка',
                'description' => 'Повітряна композиція для найтепліших моментів',
                'badge' => null,
                'image' => 'img-5.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 890,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                        ],
                    ],
                ],
            ],

            [
                'slug' => 'lavender-mood',
                'title' => 'Лавандовий настрій',
                'description' => 'Поєднання ніжності, стилю та смаку',
                'badge' => 'ТОП',
                'image' => 'img-6.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 1590,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                        ],
                    ],
                ],
            ],

            [
                'slug' => 'magic-evening',
                'title' => 'Чарівний вечір',
                'description' => 'Елегантна композиція для особливих подій',
                'badge' => null,
                'image' => 'img-7.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 1890,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                        ],
                    ],
                ],
            ],

            [
                'slug' => 'sweet-happiness',
                'title' => 'Солодке щастя',
                'description' => 'Букет, який дарує усмішку з першого погляду',
                'badge' => null,
                'image' => 'img-8.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 1090,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                        ],
                    ],
                ],
            ],

            [
                'slug' => 'coffee-romance',
                'title' => 'Кавова романтика',
                'description' => 'Теплі відтінки та витончений стиль',
                'badge' => null,
                'image' => 'img-9.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 1390,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                        ],
                    ],
                ],
            ],

            [
                'slug' => 'coffee-romance-2',
                'title' => 'Кавова романтика',
                'description' => 'Теплі відтінки та витончений стиль',
                'badge' => null,
                'image' => 'img-10.webp',

                'variants' => [
                    [
                        'name' => 'S',
                        'box_size' => 'Ø20 см',
                        'flowers_count' => 25,
                        'price' => 1390,
                        'images' => [
                            'img-1-1.webp',
                            'img-1-2.webp',
                        ],
                    ],
                    [
                        'name' => 'M',
                        'box_size' => 'Ø25 см',
                        'flowers_count' => 35,
                        'price' => 1200,
                        'images' => [
                            'img-1-2.webp',
                            'img-1-3.webp',
                        ],
                    ],
                    [
                        'name' => 'L',
                        'box_size' => 'Ø30 см',
                        'flowers_count' => 45,
                        'price' => 1500,
                        'images' => [
                            'img-1-3.webp',
                            'img-1-4.webp',
                        ],
                    ],
                    [
                        'name' => 'XL',
                        'box_size' => 'Ø35 см',
                        'flowers_count' => 60,
                        'price' => 1900,
                        'images' => [
                            'img-1-4.webp',
                            'img-1-1.webp',
                        ],
                    ],
                ],
            ],
        ];

        foreach ($bouquets as $productIndex => $bouquet) {
            $product = Product::updateOrCreate(
                ['slug' => $bouquet['slug']],
                [
                    'category_id' => $category->id,
                    'title' => $bouquet['title'],
                    'description' => $bouquet['description'],
                    'badge' => $bouquet['badge'],
                    'is_active' => true,
                    'sort_order' => $productIndex + 1,
                ]
            );

            ProductImage::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'product_variant_id' => null,
                    'path' => 'products/' . $bouquet['image'],
                ],
                [
                    'is_main' => true,
                    'sort_order' => 0,
                ]
            );

            foreach ($bouquet['variants'] as $variantIndex => $variantData) {
                $variant = ProductVariant::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $variantData['name'],
                    ],
                    [
                        'box_size' => $variantData['box_size'],
                        'flowers_count' => $variantData['flowers_count'],
                        'price' => $variantData['price'],
                        'sort_order' => $variantIndex + 1,
                    ]
                );

                foreach ($variantData['images'] as $imageIndex => $image) {
                    ProductImage::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'product_variant_id' => $variant->id,
                            'path' => 'products/' . $image,
                        ],
                        [
                            'is_main' => false,
                            'sort_order' => $imageIndex + 1,
                        ]
                    );
                }
            }
        }
    }
}