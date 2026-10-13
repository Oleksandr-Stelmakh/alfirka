<template>
    <header
        class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
        :class="[
            isScrolled
                ? 'bg-taupe-500/70 shadow-lg backdrop-blur-xl dark:border-violet-800/50 dark:bg-violet-950/75'
                : 'bg-transparent',
        ]"
    >
        <Container
            class="transition-all duration-300"
            :class="isScrolled ? 'py-1' : 'py-2 sm:py-4'"
        >
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <Link :href="route('home')" aria-label="На головну">
                        <img
                            :src="Logo"
                            alt="Alfirka"
                            class="w-auto brightness-0 invert transition-all duration-300"
                            :class="isScrolled ? 'h-16' : 'h-21.5'"
                        />
                    </Link>

                    <!-- <span class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                  Alfirka
               </span> -->
                </div>

                <nav class="hidden lg:block">
                    <ul
                        class="flex gap-3 lg:gap-6 text-gray-900 dark:text-gray-100"
                    >
                        <li v-for="item in navigation" :key="item.route">
                            <NavLink
                                :href="route(item.route)"
                                :active="route().current(item.route)"
                            >
                                {{ item.label }}
                            </NavLink>
                        </li>
                    </ul>
                </nav>

                <div class="flex items-center gap-2 sm:gap-5">
                    <!-- Instagram -->
                    <a
                        href="https://www.instagram.com/alfirka_if/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="group flex items-center gap-3"
                    >
                        <!-- Instagram gradient -->
                        <svg
                            viewBox="0 0 24 24"
                            class="h-5 w-5 shrink-0"
                            aria-hidden="true"
                        >
                            <defs>
                                <linearGradient
                                    id="instagram-gradient"
                                    x1="2"
                                    y1="22"
                                    x2="22"
                                    y2="2"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop offset="0" stop-color="#FFDC80" />
                                    <stop offset="0.2" stop-color="#F77737" />
                                    <stop offset="0.4" stop-color="#F56040" />
                                    <stop offset="0.6" stop-color="#E1306C" />
                                    <stop offset="0.8" stop-color="#833AB4" />
                                    <stop offset="1" stop-color="#4055E6" />
                                </linearGradient>
                            </defs>

                            <path
                                fill="url(#instagram-gradient)"
                                d="M7.5 2h9A5.5 5.5 0 0122 7.5v9a5.5 5.5 0 01-5.5 5.5h-9A5.5 5.5 0 012 16.5v-9A5.5 5.5 0 017.5 2zm0 2A3.5 3.5 0 004 7.5v9A3.5 3.5 0 007.5 20h9a3.5 3.5 0 003.5-3.5v-9A3.5 3.5 0 0016.5 4h-9z"
                            />

                            <path
                                fill="url(#instagram-gradient)"
                                d="M12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z"
                            />

                            <circle
                                cx="17.5"
                                cy="6.5"
                                r="1.25"
                                fill="url(#instagram-gradient)"
                            />
                        </svg>
                    </a>

                    <Link :href="route('gallery')">
                        <Button variant="primary" size="sm">
                            <Flower
                                class="hidden sm:block h-5 w-5 text-gray-200 group-hover:text-sky-300 transition-all duration-300 group-hover:rotate-360 group-hover:scale-110"
                            />

                            <span
                                class="text-xs sm:text-sm text-gray-200 group-hover:text-emerald-300"
                            >
                                Замовити букет
                            </span>
                        </Button>
                    </Link>

                    <ThemeSwitcher />

                    <BurgerButton :is-open="isMenuOpen" @toggle="toggleMenu" />
                </div>
            </div>
        </Container>
    </header>

    <!-- Мобильное меню -->
    <MobileMenu
        :is-open="isMenuOpen"
        :is-scrolled="isScrolled"
        :navigation="navigation"
        @close="isMenuOpen = false"
    />
</template>

<script setup>
import { ref, watch, onBeforeUnmount, onMounted } from "vue";
import { Link } from "@inertiajs/vue3";

import Container from "@/Components/Common/Container.vue";
import NavLink from "@/Components/UI/NavLink.vue";
import ThemeSwitcher from "@/Components/Common/ThemeSwitcher.vue";
import Logo from "@/Assets/logo.png";
import Button from "@/Components/UI/Button.vue";
import Flower from "@/Components/Icons/Flower.vue";
import MobileMenu from "@/Components/Common/MobileMenu.vue";
import BurgerButton from "@/Components/UI/BurgerButton.vue";

const isScrolled = ref(false);

const navigation = [
    { label: "Головна", route: "home" },
    { label: "Галерея", route: "gallery" },
    { label: "Кав'ярня", route: "coffee-shop" },
    { label: "Про нас", route: "about" },
    { label: "Контакти", route: "contacts" },
];

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const isMenuOpen = ref(false);

watch(isMenuOpen, (isOpen) => {
    document.body.style.overflow = isOpen ? "hidden" : "";
});

onBeforeUnmount(() => {
    document.body.style.overflow = "";

    window.removeEventListener("keydown", handleKeydown);

    window.removeEventListener("scroll", handleScroll);
});

const handleKeydown = (event) => {
    if (event.key === "Escape" && isMenuOpen.value) {
        isMenuOpen.value = false;
    }
};

const handleScroll = () => {
    isScrolled.value = window.scrollY > 30;
};

onMounted(() => {
    window.addEventListener("keydown", handleKeydown);

    window.addEventListener("scroll", handleScroll);

    handleScroll();
});
</script>
