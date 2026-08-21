<template>
    <section
        class="relative overflow-hidden"
    >

        <video
            :src="HeroVideo"
            autoplay
            muted
            loop
            playsinline
            class="absolute inset-0 h-full w-full object-cover object-[center_20%]"
        />

        <div
            class="absolute inset-0 bg-black/40"
        />

        <Container>

            <div
                class="relative z-10 flex min-h-screen items-center justify-center text-center"
            >

                <div class="mx-auto max-w-3xl space-y-6">

                    <Badge class="hero-fade hero-delay-1 text-white/90 border-white/15 bg-white/10">
                        🌸 Зефірна студія • Кав'ярня
                    </Badge>

                    <h1 class="hero-fade hero-delay-2 text-4xl sm:text-5xl lg:text-6xl xl:text-[68px] font-semibold text-white/90">
                        Смак, що перетворюється на квіти
                    </h1>

                    <p class="hero-fade hero-delay-3 mx-auto max-w-2xl text-base sm:text-lg lg:text-xl leading-relaxed text-white/80">
                        Авторські зефірні букети та композиції ручної роботи, які дивують не лише смаком, а й красою.
                        Завітайте на чашку ароматної кави з зефіркою та оберіть солодкий подарунок для близьких
                    </p>

                    <div class="hero-fade hero-delay-4 flex flex-col items-center justify-center gap-4 pt-4 md:flex-row">

                        <Button variant="primary" size="lg">
                            <Flower class="h-5 w-5 transition-transform  text-gray-200 group-hover:text-sky-300  
                                duration-300 group-hover:rotate-360 group-hover:scale-115"/>

                                <span class="text-xs sm:text-sm lg:text-lg text-gray-200 group-hover:text-emerald-300">
                                   Замовити букет
                                </span>
                            
                        </Button>

                        <Link :href="route('gallery')">
                            <Button 
                                variant="glass" 
                                size="lg" 
                                class="text-gray-100">
                                    Переглянути меню
                            </Button>
                        </Link>

                    </div>

                </div>

            </div>

        </Container>

    </section>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'

import Container from '@/Components/Common/Container.vue'
import HeroVideo from '@/Assets/videos/hero.mp4'
import Badge from '@/Components/UI/Badge.vue'
import Button from '@/Components/UI/Button.vue'
import Flower from '@/Components/Icons/Flower.vue'


</script>

<style scoped>

.hero-fade {
    opacity: 0;
    transform: translateY(100px);
    animation: heroFade .8s ease-out forwards;
}

.hero-delay-1 {
    animation-delay: .25s;
}

.hero-delay-2 {
    animation-delay: .55s;
}

.hero-delay-3 {
    animation-delay: .85s;
}

.hero-delay-4 {
    animation-delay: 1.15s;
}

@keyframes heroFade {

    from {

        opacity: 0;

        transform: translateY(100px);

    }

    to {

        opacity: 1;

        transform: translateY(0);

    }

}

</style>