<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ChirpTextArea from '@/Components/Chirp/Form/ChirpTextArea.vue';
import SubmitButton from '@/Components/Button/SubmitChirpButton.vue';
import GenerateChirpButton from '@/Components/Button/GenerateChirpButton.vue';
import ChirpSelectionModal from '@/Components/Modal/ChirpSelectionModal.vue';

const form = useForm({
    message: '',
});

const isGenerating = ref(false);
const showModal = ref(false);
const generatedChirps = ref([]);
const errorMessage = ref('');

const generateChirps = async () => {
    isGenerating.value = true;
    errorMessage.value = '';

    try {
        const response = await axios.post(route('chirps.ai.generate'));
        generatedChirps.value = response.data.chirps;
        showModal.value = true;
    } catch (error) {
        console.error('Error details:', error.response?.data || error);
        errorMessage.value =
            error.response?.data?.error || 'Failed to generate chirps';
    } finally {
        isGenerating.value = false;
    }
};

const selectChirp = (chirp) => {
    form.message = chirp.message;
    showModal.value = false;
};

const submit = () => {
    form.post(route('chirps.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <div class="card">
        <form @submit.prevent="submit">
            <ChirpTextArea
                v-model="form.message"
                placeholder="What's on your mind?"
                :maxlength="255"
            />
            <div class="mt-4 space-x-2">
                <GenerateChirpButton
                    :is-loading="isGenerating"
                    @generate="generateChirps"
                />
                <SubmitButton :disabled="form.processing"> Chirp </SubmitButton>
            </div>
        </form>

        <div v-if="errorMessage" class="mt-4 text-red-600 dark:text-red-400">
            {{ errorMessage }}
        </div>

        <ChirpSelectionModal
            :show="showModal"
            :chirps="generatedChirps"
            @close="showModal = false"
            @select="selectChirp"
        />
    </div>
</template>
