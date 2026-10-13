<template>
    <div
        class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-indigo-50 shadow-sm dark:border-gray-500 dark:bg-blue-950/20"
    >
        <!-- Заголовок и адрес -->
        <div class="p-6 sm:p-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-300">
                Кав'ярня Alfirka
            </h2>

            <p class="mt-2 text-gray-900 dark:text-gray-400">
                м. Івано-Франківськ, вул. Молодіжна, 52
            </p>
        </div>

        <!-- Google Maps -->
        <div class="h-80 sm:h-120">
            <iframe
                title="Кав'ярня Alfirka на карті"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1200.83015473126022!2d24.735694992074556!3d48.92906133590099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4730c1d73dac6591%3A0xea6ab26222555f05!2sAlfirka!5e0!3m2!1sru!2sua!4v1791539087673!5m2!1sru!2sua"
                class="h-full w-full border-0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="strict-origin-when-cross-origin"
            ></iframe>
        </div>
    </div>
</template>

<script setup></script>
