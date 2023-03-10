<script setup>
defineProps(['value']);
</script>

<template>
    <label class="text-light">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
