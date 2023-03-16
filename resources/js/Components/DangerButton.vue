<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="d-flex align-items-center px-4 py-2 btn btn-danger rounded-pill text-light"
    >
        <slot />
    </button>
</template>
