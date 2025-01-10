<script setup>
import NavigationBar from '@/Components/Navigation/NavigationBar.vue';
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <NavigationBar />
        <main class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<!-- place it in layouts folder as there might be more layouts in the future -->
