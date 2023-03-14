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
        class="btn btn-secondary border-0 text-light rounded-pill px-5"
    >
        <slot />
    </button>
</template>
