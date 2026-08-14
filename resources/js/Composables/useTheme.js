import { computed, ref,  watch } from 'vue'

const mode = ref('system')

const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)')

const systemTheme = ref(
   mediaQuery.matches
      ? 'dark'
      : 'light'
)

const theme = computed(() => {
   if (mode.value === 'light') {
      return 'light'
   }

   if (mode.value === 'dark') {
      return 'dark'
   }

   return systemTheme.value
})

let initialized = false
export function useTheme() {

  const applyTheme = () => {
      if (theme.value === 'dark') {
         document.documentElement.classList.add('dark')
      } else {
         document.documentElement.classList.remove('dark')
      }
   }

   watch(theme, () => {
      applyTheme()
      },
      {
      immediate: true,
      }
   )

   const initTheme = () => {

      if (initialized) {
         return
      }

      initialized = true

      const savedMode = localStorage.getItem('alfirka-theme-mode')

         if (savedMode) {
            mode.value = savedMode
         }

         mediaQuery.addEventListener('change', (event) => {
         systemTheme.value = event.matches ? 'dark' : 'light'
      })
   }
    
   const setMode = (value) => {
      mode.value = value

      localStorage.setItem('alfirka-theme-mode', value)
   }

   return {
      mode,
      theme,
      initTheme,
      setMode,
   }
}