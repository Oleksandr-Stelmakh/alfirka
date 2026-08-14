<template>
    <div
        class="flex flex-col items-center gap-3 text-white/70"
    >
        <div
            class="flex h-10 w-6 justify-center rounded-full border border-white/40"
        >
            <span
                class="mt-2 h-2 w-1 rounded-full bg-white/80 animate-scroll"
            />
        </div>

        <span
            class="text-xs uppercase tracking-[0.3em]"
        >
            <!-- Scroll -->
        </span>
    </div>
</template>

<style scoped>

@keyframes scroll {

    0% {

        transform: translateY(0);
        opacity: 1;

    }

    70% {

        transform: translateY(14px);
        opacity: .2;

    }

    100% {

        transform: translateY(0);
        opacity: 1;

    }

}

.animate-scroll {

    animation: scroll 2s ease-in-out infinite;

}

</style>