<script setup>
defineProps({
    isLoading: Boolean,
});

defineEmits(['generate']);
</script>

<template>
    <button
        type="button"
        @click="$emit('generate')"
        :disabled="isLoading"
        class="inline-flex items-center rounded-md bg-[#10A37F] px-4 py-2 text-white transition hover:bg-[#0E8E6D] disabled:opacity-50 dark:bg-[#0E8E6D] dark:hover:bg-[#0D7D5F]"
    >
        <svg
            v-if="isLoading"
            class="-ml-1 mr-2 h-4 w-4 animate-spin"
            fill="none"
            viewBox="0 0 24 24"
        >
            <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
            />
            <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            />
        </svg>
        {{ isLoading ? 'Generating...' : 'Generate AI Chirp' }}
    </button>
</template>
