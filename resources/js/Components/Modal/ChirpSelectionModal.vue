<script setup>
defineProps({
    show: Boolean,
    chirps: {
        type: Array,
        required: true,
    },
});

defineEmits(['close', 'select']);
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
        <!-- Backdrop -->
        <div
            class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"
            @click="$emit('close')"
        ></div>

        <!-- Modal -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-lg rounded-lg bg-white shadow-xl">
                <div class="p-6">
                    <h2 class="mb-4 text-xl font-semibold">
                        Choose Your Chirp
                    </h2>
                    <div class="space-y-4">
                        <div
                            v-for="chirp in chirps"
                            :key="chirp.type"
                            @click="$emit('select', chirp)"
                            class="cursor-pointer rounded-lg border p-4 transition hover:bg-gray-50"
                        >
                            <p class="text-sm">{{ chirp.message }}</p>
                            <span
                                class="mt-2 inline-block text-xs capitalize text-gray-500"
                            >
                                {{ chirp.type }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
