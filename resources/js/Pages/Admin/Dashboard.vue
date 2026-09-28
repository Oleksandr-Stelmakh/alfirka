<template>
    <AdminLayout>
        <!-- Заголовок Dashboard -->
        <div class="mb-8">
            <h1 class="text-3xl font-semibold">Панель керування</h1>

            <p class="mt-2 text-gray-500">Коротка інформація про замовлення.</p>
        </div>

        <!-- Основна статистика -->
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
            >
                <p class="text-sm font-medium text-gray-500">
                    Замовлення сьогодні
                </p>

                <p class="mt-3 text-3xl font-semibold text-gray-900">
                    {{ stats.ordersToday }}
                </p>
            </div>

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
            >
                <p class="text-sm font-medium text-gray-500">
                    Замовлення цього місяця
                </p>

                <p class="mt-3 text-3xl font-semibold text-gray-900">
                    {{ stats.ordersThisMonth }}
                </p>
            </div>

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
            >
                <p class="text-sm font-medium text-gray-500">Сума замовлень</p>

                <p class="mt-3 text-3xl font-semibold text-gray-900">
                    {{ formatPrice(stats.totalThisMonth) }}
                </p>
            </div>

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
            >
                <p class="text-sm font-medium text-gray-500">Середній чек</p>

                <p class="mt-3 text-3xl font-semibold text-gray-900">
                    {{ formatPrice(stats.averageOrderThisMonth) }}
                </p>
            </div>
        </div>

        <!-- Популярні товари + останні замовлення -->
        <div class="mt-8 grid gap-6 lg:grid-cols-2">
            <!-- Популярні товари -->
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >
                <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Популярні товари
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Найчастіше замовляли цього місяця
                    </p>
                </div>

                <div v-if="popularProducts.length">
                    <div
                        v-for="(product, index) in popularProducts"
                        :key="product.bouquet_title"
                        class="flex items-center justify-between border-b border-gray-100 px-6 py-4 last:border-b-0"
                    >
                        <div class="flex min-w-0 items-center gap-4">
                            <div
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gray-100 text-sm font-semibold text-gray-600"
                            >
                                {{ index + 1 }}
                            </div>

                            <p
                                class="truncate font-medium text-gray-900"
                                :title="product.bouquet_title"
                            >
                                {{ product.bouquet_title }}
                            </p>
                        </div>

                        <p
                            class="ml-4 shrink-0 text-sm font-medium text-gray-500"
                        >
                            {{ product.orders_count }}
                            {{
                                product.orders_count === 1
                                    ? "замовлення"
                                    : "замовлень"
                            }}
                        </p>
                    </div>
                </div>

                <div v-else class="px-6 py-8 text-center text-gray-500">
                    Популярних товарів поки немає.
                </div>
            </div>

            <!-- Останні замовлення -->
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >
                <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Останні замовлення
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Останні п'ять замовлень
                    </p>
                </div>

                <div
                    v-if="recentOrders.length"
                    class="divide-y divide-gray-100"
                >
                    <div
                        v-for="order in recentOrders"
                        :key="order.id"
                        class="flex flex-col gap-3 px-6 py-5 md:flex-row md:items-center md:justify-between"
                    >
                        <div class="min-w-0">
                            <p class="font-medium text-gray-900">
                                #{{ order.id }} — {{ order.name }}
                            </p>

                            <p
                                class="mt-1 truncate text-sm text-gray-500"
                                :title="order.bouquet_title"
                            >
                                {{ order.bouquet_title }}

                                <span v-if="order.size">
                                    · {{ order.size }}
                                </span>
                            </p>
                        </div>

                        <div class="shrink-0 md:text-right">
                            <p class="font-semibold text-gray-900">
                                {{ formatPrice(order.price) }}
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ formatDate(order.created_at) }}
                            </p>
                        </div>
                    </div>
                </div>

                <div v-else class="px-6 py-8 text-center text-gray-500">
                    Замовлень поки немає.
                </div>
            </div>
        </div>

        <!-- Графік замовлень -->
        <div
            class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
        >
            <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                <h2 class="text-lg font-semibold text-gray-900">
                    Замовлення за цей місяць
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Кількість замовлень по днях
                </p>
            </div>

            <div class="w-full p-5">
                <svg
                    viewBox="0 0 900 190"
                    class="block h-auto w-full"
                    preserveAspectRatio="none"
                >
                    <!-- Горизонтальні лінії -->
                    <line
                        v-for="line in chartLines"
                        :key="line.value"
                        x1="45"
                        :y1="line.y"
                        x2="885"
                        :y2="line.y"
                        stroke="#e5e7eb"
                        stroke-width="1"
                    />

                    <!-- Значення по вертикальній осі -->
                    <text
                        v-for="line in chartLines"
                        :key="`label-${line.value}`"
                        x="35"
                        :y="line.y + 3"
                        text-anchor="end"
                        class="fill-gray-400 text-[9px]"
                    >
                        {{ line.value }}
                    </text>

                    <!-- Лінія графіка -->
                    <polyline
                        v-if="chartPoints"
                        :points="chartPoints"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-gray-900"
                    />

                    <!-- Точки -->
                    <circle
                        v-for="(point, index) in chartPointList"
                        :key="index"
                        :cx="point.x"
                        :cy="point.y"
                        r="2"
                        class="fill-gray-900"
                    />

                    <!-- Дати -->
                    <text
                        v-for="label in chartDateLabels"
                        :key="label.date"
                        :x="label.x"
                        y="182"
                        text-anchor="middle"
                        class="fill-gray-400 text-[8px] sm:text-xs"
                    >
                        {{ label.label }}
                    </text>
                </svg>
            </div>
        </div>

        <!-- Відвідуваність сайту -->
        <div
            class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
        >
            <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                <h2 class="text-lg font-semibold text-gray-900">
                    Відвідуваність сайту
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Кількість відвідувачів сайту
                </p>
            </div>

            <div class="p-6">
                <div class="grid gap-6 sm:grid-cols-2">
                    <div
                        class="rounded-xl border border-gray-300 bg-gray-100 p-5"
                    >
                        <p class="text-sm font-medium text-gray-500">
                            Сьогодні
                        </p>

                        <p class="mt-2 text-3xl font-semibold text-gray-900">
                            {{ stats.visitorsToday }}
                        </p>

                        <p class="mt-1 text-sm text-gray-500">відвідувачів</p>
                    </div>

                    <div
                        class="rounded-xl border border-gray-300 bg-gray-100 p-5"
                    >
                        <p class="text-sm font-medium text-gray-500">
                            Цього місяця
                        </p>

                        <p class="mt-2 text-3xl font-semibold text-gray-900">
                            {{ stats.visitorsThisMonth }}
                        </p>

                        <p class="mt-1 text-sm text-gray-500">відвідувачів</p>
                    </div>
                </div>

                <!-- Історія по місяцях -->
                <div
                    v-if="visitorsByMonth.length"
                    class="mt-6 overflow-hidden rounded-xl border border-gray-300"
                >
                    <div
                        v-for="month in visitorsByMonth"
                        :key="month.month"
                        class="flex items-center justify-between border-b border-gray-300 bg-gray-100 px-5 py-4 last:border-b-0"
                    >
                        <p class="text-sm font-medium text-gray-700">
                            {{ formatMonth(month.month) }}
                        </p>

                        <p class="text-sm font-semibold text-gray-900">
                            {{ month.visitors }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { computed } from "vue";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

const props = defineProps({
    stats: {
        type: Object,
        required: true,
    },

    recentOrders: {
        type: Array,
        required: true,
    },

    popularProducts: {
        type: Array,
        required: true,
    },

    ordersChart: {
        type: Array,
        required: true,
    },

    visitorsByMonth: {
        type: Array,
        required: true,
    },
});

/* Графік */

const chartWidth = 810;
const chartHeight = 120;
const chartLeft = 45;
const chartTop = 10;

const maxOrders = computed(() => {
    const max = Math.max(
        ...props.ordersChart.map((item) => Number(item.orders)),
        0,
    );

    return Math.max(max, 1);
});

const chartLines = computed(() => {
    const result = [];

    for (let value = 0; value <= maxOrders.value; value++) {
        const y =
            chartTop + chartHeight - (value / maxOrders.value) * chartHeight;

        result.push({
            value,
            y,
        });
    }

    return result;
});

const chartPointList = computed(() => {
    if (!props.ordersChart.length) {
        return [];
    }

    const step =
        props.ordersChart.length > 1
            ? chartWidth / (props.ordersChart.length - 1)
            : 0;

    return props.ordersChart.map((item, index) => {
        const orders = Number(item.orders);

        const x = chartLeft + index * step;

        const y =
            chartTop + chartHeight - (orders / maxOrders.value) * chartHeight;

        return {
            x,
            y,
            orders,
        };
    });
});

const chartPoints = computed(() => {
    return chartPointList.value
        .map((point) => `${point.x},${point.y}`)
        .join(" ");
});

const chartDateLabels = computed(() => {
    if (!props.ordersChart.length) {
        return [];
    }

    const indexes = [0, 7, 14, 21, props.ordersChart.length - 1];

    return [...new Set(indexes)]
        .filter((index) => props.ordersChart[index])
        .map((index) => {
            const item = props.ordersChart[index];

            let x = chartPointList.value[index].x;

            if (index === 0) {
                x += 10;
            }

            if (index === props.ordersChart.length - 1) {
                x -= 10;
            }

            return {
                date: item.date,
                label: formatChartDate(item.date),
                x,
            };
        });
});

/* Форматирование */

const formatPrice = (value) => {
    return `${Math.round(Number(value || 0)).toLocaleString("uk-UA")} ₴`;
};

const formatDate = (value) => {
    if (!value) {
        return "";
    }

    return new Date(value).toLocaleString("uk-UA", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
};

const formatChartDate = (value) => {
    const date = new Date(`${value}T00:00:00`);

    return date.toLocaleDateString("uk-UA", {
        day: "2-digit",
        month: "2-digit",
    });
};

const formatMonth = (value) => {
    const date = new Date(`${value}-01T00:00:00`);

    return date.toLocaleDateString("uk-UA", {
        month: "long",
        year: "numeric",
    });
};
</script>
