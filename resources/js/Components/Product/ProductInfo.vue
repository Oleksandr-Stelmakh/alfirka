<template>

   <section class="px-2 sm:px-0 flex flex-col">

      <h1
         class="text-4xl font-bold text-violet-900 dark:text-white"
      >
         {{ bouquet.title }}
      </h1>

      <p
         class="mt-6 text-lg leading-8 text-violet-600 dark:text-violet-300"
      >
         {{ bouquet.shortDescription }}
      </p>

      <div class="mt-8">

         <p class="text-sm font-medium text-violet-500">
            Розмір
         </p>

         <div class="mt-3 flex flex-wrap gap-3">

            <button
               v-for="size in bouquet.sizes"
               :key="size.id"
               type="button"
               @click="selectSize(size)"
               :class="[
                  'rounded-xl border-2 px-6 py-3 font-semibold transition',
                  selectedSize.id === size.id
                     ? 'border-pink-600 bg-pink-600 text-white shadow-md'
                     : 'border-violet-200 bg-white text-violet-700 hover:border-pink-400 dark:border-violet-700 dark:bg-violet-900 dark:text-violet-200',
               ]"
            >
               {{ size.name }}
            </button>

         </div>

      </div>

      <div class="mt-8 flex flex-wrap gap-3">

         <span
            class="rounded-full bg-violet-100 px-4 py-2 dark:bg-violet-800 text-violet-700 dark:text-violet-200"
         >
            📦 {{ selectedSize.boxSize }}
         </span>

         <span
            class="rounded-full bg-pink-100 px-4 py-2 dark:bg-pink-900/50 text-pink-700 dark:text-pink-200"
         >
            🌸 {{ selectedSize.flowersCount }} квітів
         </span>

      </div>

      <div class="mt-10">

         <p
            class="text-sm uppercase tracking-[0.3em] text-violet-500"
         >
            Ціна
         </p>

         <p
            class="mt-2 text-5xl font-bold text-pink-600"
         >
            {{ selectedSize.price }} грн
         </p>

      </div>

      <Button
          size="lg"
          class="mt-10 w-full max-w-125 self-center lg:max-w-none lg:self-auto hover:text-emerald-300"
      >
          Замовити букет
      </Button>
      <!-- <button
         class="mt-10 w-full max-w-125 self-center rounded-2xl bg-pink-500 px-8 py-4 text-lg font-semibold text-white transition
           hover:text-emerald-300 hover:bg-pink-600 lg:max-w-none lg:self-auto"
      >
         Замовити букет
      </button> -->

   </section>

</template>


<script setup>
import Button from '@/Components/UI/Button.vue'

const props = defineProps({
    bouquet: {
        type: Object,
        required: true,
    },

    selectedSize: {
        type: Object,
        required: true,
    },
})

const emit = defineEmits([
    'select-size',
])

function selectSize(size) {
    emit('select-size', size)
}
</script>