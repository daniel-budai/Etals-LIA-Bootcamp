<script setup>
import { Link } from '@inertiajs/vue3';
import ThemeToggle from '@/Components/ThemeToggle.vue';
</script>

<template>
    <nav class="bg-white shadow dark:bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    <template v-if="$page.props.auth.user">
                        <span class="text-gray-600 dark:text-gray-300">
                            {{ $page.props.auth.user.name }}
                        </span>
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                        >
                            Logout
                        </Link>
                    </template>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                        >
                            Login
                        </Link>
                        <Link
                            :href="route('register')"
                            class="rounded-md bg-gray-800 px-4 py-2 text-white hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600"
                        >
                            Register
                        </Link>
                    </template>
                    <ThemeToggle />
                </div>
            </div>
        </div>
    </nav>
</template>
