<template>
    <section class="bg-rose-50/60 py-16 dark:bg-rose-950/20 sm:py-24">
        <Container>
            <SectionHeader
                badge="🌸 Наш підхід"
                title="Особливі деталі мають значення"
                description="Ми хочемо, щоб кожна композиція була не просто подарунком, а приємним спогадом."
            />

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <FeatureCard
                    v-for="feature in features"
                    :key="feature.title"
                    :title="feature.title"
                    :description="feature.description"
                >
                    <div
                        class="flex h-28 items-center justify-center bg-rose-50 dark:bg-rose-950/30"
                    >
                        <span class="text-4xl" aria-hidden="true">
                            {{ feature.icon }}
                        </span>
                    </div>
                </FeatureCard>
            </div>
        </Container>
    </section>
</template>

<script setup>
import Container from "@/Components/Common/Container.vue";
import SectionHeader from "@/Components/UI/SectionHeader.vue";
import FeatureCard from "@/Components/UI/FeatureCard.vue";

const features = [
    {
        icon: "🌷",
        title: "Квіткова естетика",
        description:
            "Композиції, натхненні красою квітів і ніжністю природних відтінків.",
    },
    {
        icon: "🤲",
        title: "Увага до деталей",
        description:
            "Важливі не лише загальний вигляд букета, а й охайність оформлення та подачі.",
    },
    {
        icon: "🎁",
        title: "Подарунок з емоцією",
        description:
            "Незвичайний спосіб привітати близьку людину, подякувати або зробити приємний сюрприз.",
    },
    {
        icon: "☕",
        title: "Більше приводів завітати",
        description:
            "Окрім букетів, в Alfirka можна завітати на каву та провести приємний час.",
    },
];
</script>
