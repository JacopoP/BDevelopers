<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="d-inline-flex align-items-center btn bg-secondary rounded text-light px-4 py-2"
    >
        <slot />
    </button>
</template>
