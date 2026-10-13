<template>
    <div class="flex items-center">
        <button
            type="button"
            class="relative h-6 w-10 shrink-0 rounded-full border border-pink-400 bg-white/10 backdrop-blur-lg shadow-sm transition-colors duration-200 dark:border-violet-500"
            :aria-label="
                theme === 'dark'
                    ? 'Увімкнути світлу тему'
                    : 'Увімкнути темну тему'
            "
            :aria-pressed="theme === 'dark'"
            @click="toggleTheme"
        >
            <span
                class="absolute left-0.5 top-0.5 flex size-4.5 items-center justify-center rounded-full bg-taupe-100 shadow-md transition-transform duration-200 dark:bg-gray-900"
                :class="theme === 'dark' ? 'translate-x-4' : 'translate-x-0'"
            >
                <Sun v-if="theme !== 'dark'" class="size-3.5 text-amber-500" />
                <Moon v-else class="size-3.5 text-sky-400" />
            </span>
        </button>
    </div>
</template>

<script setup>
import { Moon, Sun } from "lucide-vue-next";
import { useTheme } from "@/Composables/useTheme";

const { theme, setMode } = useTheme();

const toggleTheme = () => {
    setMode(theme.value === "dark" ? "light" : "dark");
};
</script>
