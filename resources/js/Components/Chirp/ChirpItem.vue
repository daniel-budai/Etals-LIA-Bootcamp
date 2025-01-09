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
    <div class="p-6">
        <div class="flex justify-between">
            <div>
                <span class="font-bold">{{ chirp.user.name }}</span>
                <small class="ml-2 text-gray-600">
                    {{ new Date(chirp.created_at).toLocaleString() }}
                    <span
                        v-if="hasBeenEdited"
                        class="ml-2 text-sm text-gray-500"
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
                <textarea
                    v-model="form.message"
                    class="mt-4 w-full rounded-md border-gray-300 text-gray-900 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                ></textarea>
                <div class="space-x-2">
                    <button
                        class="mt-4 rounded-md bg-gray-800 px-4 py-2 text-white"
                    >
                        Save
                    </button>
                    <button
                        class="mt-4 rounded-md bg-gray-400 px-4 py-2 text-white"
                        @click="isEditing = false"
                    >
                        Cancel
                    </button>
                </div>
            </form>
            <p v-else class="mt-4 text-lg text-gray-900">
                {{ chirp.message }}
            </p>
        </div>
    </div>
</template>
