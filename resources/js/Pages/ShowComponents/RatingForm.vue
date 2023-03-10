<script setup>
import { useForm } from '@inertiajs/vue3';
const props = defineProps([
    'developer',
]);

const form = useForm({
    rating: null,
});

// function submit() {
//     if (form.text !== null) {
//         form.post(route('review.store', props.developer.id))
//     }
// }

</script>

<template>
    <form method="post" @submit.prevent="form.post(route('rating.store', developer.id))">
        <br>
        <select v-model="form.rating" id="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="submit" value="Send a rating">
    </form>
</template>