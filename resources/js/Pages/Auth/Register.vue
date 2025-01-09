<script setup>
import { useForm, router } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onSuccess: () => {
            router.visit('/');
        },
    });
};
</script>

<template>
    <MainLayout>
        <div class="mx-auto max-w-md">
            <form
                @submit.prevent="submit"
                class="rounded-lg bg-white p-6 shadow-sm"
            >
                <h2 class="mb-6 text-2xl font-bold">Register</h2>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700"
                        >Name</label
                    >
                    <input
                        v-model="form.name"
                        type="text"
                        required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                    />
                    <div
                        v-if="form.errors.name"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.name }}
                    </div>
                </div>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700"
                        >Email</label
                    >
                    <input
                        v-model="form.email"
                        type="email"
                        required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                    />
                    <div
                        v-if="form.errors.email"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.email }}
                    </div>
                </div>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700"
                        >Password</label
                    >
                    <input
                        v-model="form.password"
                        type="password"
                        required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                    />
                    <div
                        v-if="form.errors.password"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.password }}
                    </div>
                </div>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>
                    <input
                        v-model="form.password_confirmation"
                        type="password"
                        required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full rounded-md bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                    :disabled="form.processing"
                >
                    Register
                </button>
            </form>
        </div>
    </MainLayout>
</template>
