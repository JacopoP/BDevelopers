<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps([
    'developer',
]);

const form = useForm({
    ratind: null,
    email: null,
    full_name: null,
});

// function submit() {
//     if (form.text !== null) {
//         form.post(route('review.store', props.developer.id))
//     }
// }

</script>

<template>
    <form method="post" @submit.prevent="form.post(route('message.store', developer.id))">
        <label for="full_name">Your Name</label>
        <br>
        <TextInput id="full_name" type="text" v-model="form.full_name" required autocomplete="name" />
        <br>
        <label for="email">Your email</label>
        <br>
        <TextInput id="email" type="email" v-model="form.email" required autocomplete="name" />
        <br>
        <label for="text">Message text</label>
        <br>
        <textarea id="text" v-model="form.text"></textarea>
        <br>
        <input type="submit" value="Send a message">
    </form>
</template>