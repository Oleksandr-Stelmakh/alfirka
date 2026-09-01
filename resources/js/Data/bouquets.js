import Gallery1 from '@/Assets/images-optimized/works/img-1.webp'
import Gallery1_1 from '@/Assets/images-optimized/works/img-1-1.webp'
import Gallery1_2 from '@/Assets/images-optimized/works/img-1-2.webp'
import Gallery1_3 from '@/Assets/images-optimized/works/img-1-3.webp'
import Gallery1_4 from '@/Assets/images-optimized/works/img-1-4.webp'
import Gallery2 from '@/Assets/images-optimized/works/img-2.webp'
import Gallery3 from '@/Assets/images-optimized/works/img-3.webp'
import Gallery4 from '@/Assets/images-optimized/works/img-4.webp'
import Gallery5 from '@/Assets/images-optimized/works/img-5.webp'
import Gallery6 from '@/Assets/images-optimized/works/img-6.webp'
import Gallery7 from '@/Assets/images-optimized/works/img-7.webp'
import Gallery8 from '@/Assets/images-optimized/works/img-8.webp'
import Gallery9 from '@/Assets/images-optimized/works/img-9.webp'
import Gallery10 from '@/Assets/images-optimized/works/img-10.webp'


const bouquets = [
    {
        id: 1,
        slug: 'flower-tenderness',
        title: 'Квіткова ніжність',
        image: Gallery1,
        shortDescription: 'Ніжний букет із натурального зефіру ручної роботи',
        

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 900,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                ],
            },
        ],

        priceFrom: 900,
        badge: 'Новинка',
    },

    {
        id: 2,
        slug: 'strawberry-morning',
        title: 'Полуничний ранок',
        image: Gallery2,
        shortDescription: 'Легка композиція у ніжних рожевих відтінках',

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 990,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                    Gallery2
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                    Gallery2,
                    Gallery6,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                    Gallery2,
                    Gallery8,
                    Gallery5,
                ],
            },
        ],

        priceFrom: 990,
        badge: 'Акція',
    },

    {
        id: 3,
        slug: 'sweet-love',
        title: 'Солодке кохання',
        image: Gallery3,
        shortDescription: 'Ідеальний подарунок для особливого дня',

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 1190,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                ],
            },
        ],

        priceFrom: 1190,
        badge: 'Хіт',
    },

    {
        id: 4,
        slug: 'berry-dream',
        title: 'Ягідна мрія',
        image: Gallery4,
        shortDescription: 'Яскравий букет із полуничними нотками',

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 1490,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                ],
            },
        ],

        priceFrom: 1490,
        badge: '-15%',
    },

    {
        id: 5,
        slug: 'pink-cloud',
        title: 'Рожева хмаринка',
        image: Gallery5,
        shortDescription: 'Повітряна композиція для найтепліших моментів',

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 890,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                ],
            },
        ],

        priceFrom: 890,
    },

    {
        id: 6,
        slug: 'lavender-mood',
        title: 'Лавандовий настрій',
        image: Gallery6,
        shortDescription: 'Поєднання ніжності, стилю та смаку',

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 1590,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                ],
            },
        ],

        priceFrom: 1590,
        badge: 'ТОП',
    },

    {
        id: 7,
        slug: 'magic-evening',
        title: 'Чарівний вечір',
        image: Gallery7,
        shortDescription: 'Елегантна композиція для особливих подій',

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 1890,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                ],
            },
        ],

        priceFrom: 1890,
    },

    {
        id: 8,
        slug: 'sweet-happiness',
        title: 'Солодке щастя',
        image: Gallery8,
        shortDescription: 'Букет, який дарує усмішку з першого погляду',

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 1090,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                ],
            },
        ],

        priceFrom: 1090,
    },

    {
        id: 9,
        slug: 'coffee-romance',
        title: 'Кавова романтика',
        image: Gallery9,
        shortDescription: 'Теплі відтінки та витончений стиль',

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 1390,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                ],
            },
        ],

        priceFrom: 1390,
    },

     {
        id: 10,
        slug: 'coffee-romance-2',
        title: 'Кавова романтика',
        image: Gallery10,
        shortDescription: 'Теплі відтінки та витончений стиль',

        sizes: [
            {
                id: 's',
                name: 'S',
                boxSize: 'Ø20 см',
                flowersCount: 25,
                price: 1390,

                images: [
                    Gallery1_1,
                    Gallery1_2,
                ],
            },

            {
                id: 'm',
                name: 'M',
                boxSize: 'Ø25 см',
                flowersCount: 35,
                price: 1200,

                images: [
                    Gallery1_2,
                    Gallery1_3,
                ],
            },

            {
                id: 'l',
                name: 'L',
                boxSize: 'Ø30 см',
                flowersCount: 45,
                price: 1500,

                images: [
                    Gallery1_3,
                    Gallery1_4,
                ],
            },

            {
                id: 'xl',
                name: 'XL',
                boxSize: 'Ø35 см',
                flowersCount: 60,
                price: 1900,
                
                images: [
                    Gallery1_4,
                    Gallery1_1,
                ],
            },
        ],
        priceFrom: 1390,
    },
]

export default bouquets
