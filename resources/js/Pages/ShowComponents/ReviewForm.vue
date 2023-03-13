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
        <label for="text">Review</label>
        <br>
        <textarea class="layout" id="text" v-model="form.text"></textarea>
        <br>
        <label for="full_name">Add your Name</label>
        <br>
        <input class="layout" type="text" v-model="form.full_name">
        <br>
        <input class="_button _blue" type="submit" value="Send a Review">
    </form>
</template>

<style lang="scss" scoped>
@use 'resources/sass/general.scss' as *;

.layout {
    width: 100%;
    background-color: $background;
    border-radius: 10px;
}

._button {
    color: $titles;
    padding: 10px;
    border-radius: 20px;
    margin-top: 15px;
    width: 100%;
}
</style>