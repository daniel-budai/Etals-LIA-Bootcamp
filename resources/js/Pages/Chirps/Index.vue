<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ChirpList from '@/Components/Chirp/ChirpList.vue';
import CreateChirp from '@/Components/Chirp/Form/CreateChirp.vue';

defineProps({
    chirps: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <MainLayout>
        <div class="mx-auto max-w-2xl p-4 sm:p-6 lg:p-8">
            <CreateChirp v-if="$page.props.auth.user" />

            <div v-else class="rounded-lg bg-white p-6 shadow-sm">
                <p class="text-gray-600">Please log in to create a chirp!</p>
            </div>

            <ChirpList :chirps="chirps" />
        </div>
    </MainLayout>
</template>
