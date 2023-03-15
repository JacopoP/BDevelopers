<script setup>
import { useForm } from '@inertiajs/vue3';
const props = defineProps([
    'developer',
]);

const form = useForm({
    text: null,
    full_name: null,
});

function submit() {
    if (form.text !== null) {
        form.post(route('review.store', props.developer.id))
    }
}

</script>

<template>
    <form method="post" @submit.prevent="submit">
        <label class="text-light" for="text">Review</label>
        <br>
        <textarea class="layout bg-dark" id="text" v-model="form.text"></textarea>
        <br>
        <label class="text-light" for="full_name">Add your Name</label>
        <br>
        <input class="layout bg-dark" type="text" v-model="form.full_name">
        <br>
        <input class="_button _blue text-light border-0" type="submit" value="Send a Review">
    </form>
</template>

<style lang="scss" scoped>
// @use 'resources/sass/variable.scss' as *;
@use 'resources/sass/devShow-layout-style.scss' as *;

.layout {
    width: 100%;
    border-radius: 10px;
}

label {
    position: relative;
    top: 10px;
    background: $brand_background;
    padding: 0 8px;
}

._button {
    padding: 10px;
    border-radius: 20px;
    margin-top: 15px;
    width: 100%;
}
</style>