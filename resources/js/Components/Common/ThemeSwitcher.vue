<template>
   <div class="flex items-center gap-4">

      <div
         class="relative flex h-8 w-22 sm:w-24 items-center rounded-full border border-pink-500/50
          bg-white/10 backdrop-blur-lg
            shadow-[0_0_12px_rgba(139,92,246,0.4)]
            dark:shadow-[0_0_14px_rgba(139,92,246,0.4)]
            p-1 transition-all duration-300"
      >

         <button
            @click="setMode('light')"
            class="z-10 flex flex-1 justify-center border-none"
         >
            <Sun
                  class="h-4 w-4 transition-all duration-300"
                  :class="
                     mode === 'light'
                        ? 'text-amber-500 scale-110'
                        : 'text-amber-300 opacity-50'
                  "
            />
         </button>

         <button
            @click="setMode('system')"
            class="z-10 flex flex-1 justify-center border-none"
         >
            <Monitor
               class="h-4 w-4 transition-all duration-300"
               :class="
                  mode === 'system'
                     ? 'text-sky-500 scale-110'
                     : 'text-sky-300 opacity-50'
               "
                     />
         </button>

         <button
            @click="setMode('dark')"
            class="z-10 flex flex-1 justify-center border-none"
         >
            <Moon
                  class="h-4 w-4 transition-all duration-300"
               :class="
                  mode === 'dark'
                     ? 'text-indigo-500 scale-110'
                     : 'text-indigo-300 opacity-50'
               "
            />
         </button>

         <div
            class="absolute top-4 h-1 w-1 rounded-full border text-cyan-500
             bg-cyan-500 shadow-md transition-all duration-300"
            :class="{
               'translate-x-1 shadow-[0_0_10px_rgba(251,191,36,0.45)]': mode === 'light',
               'translate-x-8 shadow-[0_0_10px_rgba(59,130,246,0.45)]': mode === 'system',
               'translate-x-15 shadow-[0_0_10px_rgba(139,92,246,0.45)]': mode === 'dark',
            }"
         />

      </div>

   </div>
</template>

<script setup>
import { Moon, Sun, Monitor } from 'lucide-vue-next'
import { useTheme } from '@/Composables/useTheme'

const { mode, setMode } = useTheme()

</script>