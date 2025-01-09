<script setup>
defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button
        type="submit"
        :disabled="disabled"
        class="mt-4 rounded-md bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
    >
        <slot />
    </button>
</template>
