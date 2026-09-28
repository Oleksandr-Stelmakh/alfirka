<template>
    <footer
        class="border-t border-gray-200 bg-gray-200 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"
    >
        <div class="mx-auto max-w-7xl px-6 pt-14">
            <div class="grid gap-10 md:grid-cols-3">
                <!-- Brand -->
                <div>
                    <Link
                        :href="route('home')"
                        class="inline-flex items-center gap-10"
                        aria-label="На головну"
                    >
                        <img
                            :src="Logo"
                            alt="Alfirka"
                            class="h-20 w-auto brightness-0 dark:brightness-0 dark:invert transition-all duration-300"
                        />

                        <h2 class="text-2xl font-semibold tracking-wide">
                            Alfirka
                            <p class="text-xs text-gray-300">
                                Студія зефірної флористики
                            </p>
                        </h2>
                    </Link>

                    <div
                        class="mt-1 h-px w-80 bg-gray-400 dark:bg-gray-600"
                    ></div>

                    <p
                        class="mt-3 max-w-sm text-sm leading-6 text-gray-600 dark:text-gray-400"
                    >
                        Букети з зефіру ручної роботи, створені з любов'ю та
                        увагою до кожної деталі, щоб ви могли насолодитися
                        незабутнім смаком та прихопити для рідних чи друзів
                        приємний подаруночок .
                    </p>
                </div>

                <!-- Navigation -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider">
                        Навігація
                    </h3>

                    <nav class="mt-4">
                        <ul class="flex flex-col items-start gap-2">
                            <li v-for="item in navigation" :key="item.route">
                                <NavLink
                                    :href="route(item.route)"
                                    :active="route().current(item.route)"
                                    variant="footer"
                                >
                                    {{ item.label }}
                                </NavLink>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Contacts -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider">
                        Контакти
                    </h3>

                    <div
                        class="mt-4 space-y-4 text-sm text-gray-600 dark:text-gray-400"
                    >
                        <p>📞 Телефон — буде додано</p>

                        <p>✉️ Email — буде додано</p>

                        <p>📱 Instagram — буде додано</p>
                    </div>
                </div>
            </div>

            <!-- Bottom -->
            <div
                class="mt-10 border-t border-gray-200 py-4 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-500"
            >
                © {{ currentYear }} Alfirka. Усі права захищені.
            </div>
        </div>
    </footer>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import NavLink from "@/Components/UI/NavLink.vue";
import Logo from "@/Assets/logo.png";

const currentYear = new Date().getFullYear();

const navigation = [
    { label: "Головна", route: "home" },
    { label: "Галерея", route: "gallery" },
    { label: "Кав'ярня", route: "coffee-shop" },
    { label: "Про нас", route: "about" },
    { label: "Контакти", route: "contacts" },
];
</script>
