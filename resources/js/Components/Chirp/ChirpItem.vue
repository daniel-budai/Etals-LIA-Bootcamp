<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ChirpDropdown from './ChirpDropdown.vue';

const props = defineProps({
    chirp: {
        type: Object,
        required: true,
    },
});

const isEditing = ref(false);
const form = useForm({
    message: props.chirp.message,
});

const hasBeenEdited = computed(() => {
    return new Date(props.chirp.updated_at) > new Date(props.chirp.created_at);
});

const submit = () => {
    form.put(`/${props.chirp.id}`, {
        onSuccess: () => (isEditing.value = false),
    });
};

const deleteChirp = () => {
    if (confirm('Are you sure you want to delete this chirp?')) {
        form.delete(`/${props.chirp.id}`);
    }
};
</script>

<template>
    <div class="card">
        <div class="flex justify-between">
            <div>
                <span class="text-primary font-bold">{{
                    chirp.user.name
                }}</span>
                <small class="text-secondary ml-2">
                    {{ new Date(chirp.created_at).toLocaleString() }}
                    <span
                        v-if="hasBeenEdited"
                        class="text-secondary ml-2 text-sm"
                    >
                        (edited)
                    </span>
                </small>
            </div>

            <ChirpDropdown
                v-if="chirp.user.id === $page.props.auth.user?.id"
                :chirp="chirp"
                @edit="isEditing = true"
                @delete="deleteChirp"
            />
        </div>

        <div class="mt-4">
            <form v-if="isEditing" @submit.prevent="submit">
                <textarea v-model="form.message" class="input-field"></textarea>
                <div class="space-x-2">
                    <button class="btn-primary">Save</button>
                    <button
                        class="mt-4 rounded-md bg-gray-400 px-4 py-2 text-white hover:bg-gray-500 dark:bg-gray-600 dark:hover:bg-gray-500"
                        @click="isEditing = false"
                        type="button"
                    >
                        Cancel
                    </button>
                </div>
            </form>
            <p v-else class="text-primary mt-4 text-lg">
                {{ chirp.message }}
            </p>
        </div>
    </div>
</template>
