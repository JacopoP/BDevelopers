<script setup>
import { useForm } from '@inertiajs/vue3';
const props = defineProps([
    'developer',
]);

const form = useForm({
    text: null,
    full_name: null,
});

// function submit() {
//     if (form.text !== null) {
//         form.post(route('review.store', props.developer.id))
//     }
// }

</script>

<template>
    <form method="post" @submit.prevent="form.post(route('review.store', developer.id))">
        <label for="text">review</label>
        <br>
        <textarea id="text" v-model="form.text"></textarea>
        <br>
        <label for="full_name">If u want to add your name</label>
        <br>
        <input type="text" v-model="form.full_name">
        <input type="submit" value="Send a review">
    </form>
</template>