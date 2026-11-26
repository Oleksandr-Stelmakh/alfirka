<template>
    <Transition
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="opacity-0 -translate-y-2"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 -translate-y-2"
    >
        <div
            v-if="isVisible"
            class="relative z-30 w-full px-10 py-1 text-center shadow-sm"
            :style="bannerStyle"
        >
            <p class="text-sm font-medium leading-relaxed sm:text-base">
                {{ announcement.message }}
            </p>

            <button
                v-if="announcement.can_be_closed"
                type="button"
                aria-label="Закрити оголошення"
                title="Закрити оголошення"
                class="absolute right-3 top-1/2 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full transition hover:bg-black/10"
                @click="dismiss"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
    </Transition>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const announcement = computed(() => page.props.siteAnnouncement);

const currentTime = ref(Date.now());
const dismissed = ref(false);

let timer = null;
let isMounted = false;

const dismissalKey = computed(() => {
    if (!announcement.value) {
        return null;
    }

    const item = announcement.value;

    return [
        "alfirka-announcement",
        item.id,
        item.updated_at,
        item.message,
        item.theme,
        item.starts_at,
        item.ends_at,
    ].join(":");
});

const isVisible = computed(() => {
    if (!announcement.value || dismissed.value) {
        return false;
    }

    const now = currentTime.value;
    const start = new Date(announcement.value.starts_at).getTime();
    const end = new Date(announcement.value.ends_at).getTime();

    return now >= start && now < end;
});

const getContrastColor = (hex) => {
    const color = hex.replace("#", "");

    const red = parseInt(color.substring(0, 2), 16);
    const green = parseInt(color.substring(2, 4), 16);
    const blue = parseInt(color.substring(4, 6), 16);

    const brightness = (red * 299 + green * 587 + blue * 114) / 1000;

    return brightness >= 150 ? "#1f2937" : "#ffffff";
};

const bannerStyle = computed(() => {
    const color = announcement.value?.theme || "#702b3a";

    return {
        backgroundColor: color,
        color: getContrastColor(color),
    };
});

const loadDismissal = () => {
    if (!dismissalKey.value) {
        dismissed.value = false;
        return;
    }

    dismissed.value = localStorage.getItem(dismissalKey.value) === "1";
};

const scheduleNextUpdate = () => {
    if (timer) {
        clearTimeout(timer);
        timer = null;
    }

    if (!announcement.value) {
        return;
    }

    const now = Date.now();
    const start = new Date(announcement.value.starts_at).getTime();
    const end = new Date(announcement.value.ends_at).getTime();

    let nextTime = null;

    if (now < start) {
        nextTime = start;
    } else if (now < end) {
        nextTime = end;
    }

    if (nextTime !== null) {
        const delay = Math.min(Math.max(nextTime - now + 50, 50), 2147480000);

        timer = setTimeout(() => {
            currentTime.value = Date.now();
            scheduleNextUpdate();
        }, delay);
    }
};

const dismiss = () => {
    if (!dismissalKey.value) {
        return;
    }

    localStorage.setItem(dismissalKey.value, "1");
    dismissed.value = true;
};

watch(dismissalKey, () => {
    if (!isMounted) {
        return;
    }

    loadDismissal();
    scheduleNextUpdate();
});

onMounted(() => {
    isMounted = true;

    currentTime.value = Date.now();

    loadDismissal();
    scheduleNextUpdate();
});

onUnmounted(() => {
    if (timer) {
        clearTimeout(timer);
    }
});
</script>
