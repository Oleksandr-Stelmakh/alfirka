<template>
    <footer class="border-t bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        <div class="mx-auto max-w-7xl px-4 py-6">
            <div class="text-center text-sm text-gray-500">
                © {{ currentYear }} Alfirka. Усі права захищені.
            </div>
        </div>
    </footer>
</template>

<script setup>
const currentYear = new Date().getFullYear()
</script>