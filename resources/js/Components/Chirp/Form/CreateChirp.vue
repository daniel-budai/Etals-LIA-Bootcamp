<script setup>
import { useForm } from '@inertiajs/vue3';
import ChirpTextArea from '@/Components/Chirp/Form/ChirpTextArea.vue';
import SubmitButton from '@/Components/Button/SubmitChirpButton.vue';

const form = useForm({
    message: '',
});

const submit = () => {
    form.post(route('chirps.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <div class="rounded-lg bg-white p-6 shadow-sm">
        <form @submit.prevent="submit">
            <ChirpTextArea
                v-model="form.message"
                placeholder="What's on your mind?"
                :maxlength="255"
            />
            <SubmitButton :disabled="form.processing"> Chirp </SubmitButton>
        </form>
    </div>
</template>
