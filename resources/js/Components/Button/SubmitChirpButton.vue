<script setup>
defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button type="submit" :disabled="disabled" class="btn-primary">
        <slot />
    </button>
</template>
