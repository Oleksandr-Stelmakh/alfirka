<template>

   <section>

      <div class="relative">

          <img
              :src="selectedImage"
              :alt="bouquet.title"
              class="h-auto max-h-160 w-full rounded-3xl object-cover shadow-xl"
          >

          <!-- Предыдущая фотография -->
          <button
              type="button"
              @click="previousImage"
              :disabled="selectedImageIndex === 0"
              class="absolute left-4 top-1/2 flex justify-center font-light leading-none items-center h-11 w-11 -translate-y-1/2 rounded-full 
              bg-white/35 text-violet-900/50 hover:text-violet-900/80 shadow-lg backdrop-blur transition hover:bg-white/60 
              disabled:pointer-events-none disabled:opacity-30"
              aria-label="Попереднє фото"
          >
               <svg
                   xmlns="http://www.w3.org/2000/svg"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="1.8"
                   class="h-6 w-6"
               >
                   <path
                       stroke-linecap="round"
                       stroke-linejoin="round"
                       d="M15 19l-7-7 7-7"
                   />
               </svg>
          </button>

          <!-- Следующая фотография -->
          <button
              type="button"
              @click="nextImage"
              :disabled="
                  selectedImageIndex >=
                  (selectedSize.images?.length ?? 1) - 1
              "
              class="absolute right-4 top-1/2 flex justify-center font-light leading-none items-center h-11 w-11 -translate-y-1/2 rounded-full 
              bg-white/35 text-violet-900/50 hover:text-violet-900/80 shadow-lg backdrop-blur transition hover:bg-white/60 
              disabled:pointer-events-none disabled:opacity-30"
              aria-label="Наступне фото"
          >
              <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                  class="h-6 w-6"
               >
                  <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7"
                  />
               </svg>
          </button>

      </div>

      <!-- Миниатюры -->
      <div class="mt-6 flex gap-4 overflow-x-auto pb-2">

         <button
            v-for="(image, index) in selectedSize.images ?? []"
            :key="`${selectedSize.id}-${index}`"
            type="button"
            @click="selectImage(image, index)"
            :class="[
               'shrink-0 overflow-hidden rounded-2xl border-2 transition',
               selectedImageIndex === index
                  ? 'border-pink-600 shadow-md'
                  : 'border-transparent hover:border-violet-400',
            ]"
         >
            <img
               :src="image"
               :alt="`${bouquet.title} — фото ${index + 1}`"
               class="h-24 w-24 object-cover"
            >
         </button>

      </div>

   </section>

</template>

<script setup>
import { ref, watch } from 'vue'

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

const selectedImage = ref(props.selectedSize.images?.[0] ?? props.bouquet.image)

const selectedImageIndex = ref(0)

function selectImage(image, index) {
    selectedImage.value = image
    selectedImageIndex.value = index
}

function previousImage() {
    if (selectedImageIndex.value === 0) {
        return
    }

    selectedImageIndex.value--

    selectedImage.value =
        props.selectedSize.images[selectedImageIndex.value]
}

function nextImage() {
    if (
        selectedImageIndex.value >=
        props.selectedSize.images.length - 1
    ) {
        return
    }

    selectedImageIndex.value++

    selectedImage.value =
        props.selectedSize.images[selectedImageIndex.value]
}

watch(
   () => props.selectedSize,
   (newSize) => {
      selectedImageIndex.value = 0

      selectedImage.value = newSize.images?.[0] ?? props.bouquet.image
   }
)
</script>