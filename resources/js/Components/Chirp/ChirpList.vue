<script setup>
import ChirpItem from '@/Components/Chirp/ChirpItem.vue';

defineProps({
    chirps: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div class="mt-6 space-y-4">
        <ChirpItem
            v-for="chirp in chirps"
            :key="chirp.id"
            :chirp="chirp"
            class="rounded-lg bg-white shadow-sm"
        />
    </div>
</template>
