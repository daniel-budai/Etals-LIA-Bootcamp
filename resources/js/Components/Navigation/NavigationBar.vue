<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    <template v-if="$page.props.auth.user">
                        <span class="text-gray-600">{{
                            $page.props.auth.user.name
                        }}</span>
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="text-gray-600 hover:text-gray-900"
                        >
                            Logout
                        </Link>
                    </template>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="text-gray-600 hover:text-gray-900"
                        >
                            Login
                        </Link>
                        <Link
                            :href="route('register')"
                            class="rounded-md bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </div>
        </div>
    </nav>
</template>
