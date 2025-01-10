<script setup>
defineProps({
    modelValue: String,
    maxlength: Number,
    placeholder: String,
});

defineEmits(['update:modelValue']);
</script>

<template>
    <textarea
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="input-field"
        :maxlength="maxlength"
        :placeholder="placeholder"
    ></textarea>
</template>
