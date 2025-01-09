<script setup>
defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    placeholder: {
        type: String,
        default: '',
    },
    maxlength: {
        type: Number,
        default: 255,
    },
});
</script>

<template>
    <div>
        <textarea
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :placeholder="placeholder"
            :maxlength="maxlength"
            required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        ></textarea>
        <div class="mt-2 text-sm text-gray-500">
            {{ modelValue.length }}/{{ maxlength }} characters
        </div>
    </div>
</template>
