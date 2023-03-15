<script setup>
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps([
    'developer',
]);

const form = useForm({
    text: null,
    email: null,
    full_name: null,
});

function submit() {
    if (form.text !== null) {
        form.post(route('message.store', props.developer.id))
    }
}

</script>

<template>
    <form method="post" @submit.prevent="submit">
        <label class="text-light" for="full_name">Your Name</label>
        <br>
        <TextInput class="layout text-light" id="full_name" type="text" v-model="form.full_name" required
            autocomplete="name" />
        <br>
        <label class="text-light" for="email">Your email</label>
        <br>
        <TextInput class="layout text-light" id="email" type="email" v-model="form.email" required autocomplete="name" />
        <br>
        <label class="text-light" for="text">Message text</label>
        <br>
        <textarea class="layout bg-dark" id="text" v-model="form.text"></textarea>
        <br>
        <input class="_button _blue text-light border-0" type="submit" value="Send a Message">
    </form>
</template>

<style lang="scss" scoped>
// @use 'resources/sass/variable.scss' as *;
@use 'resources/sass/devShow-layout-style.scss' as *;

label {
    position: relative;
    top: 10px;
    background: $brand_background;
    padding: 0 8px;
}

.layout {
    width: 100%;
    border-radius: 10px;
}

._button {
    padding: 10px;
    border-radius: 20px;
    margin-top: 15px;
    width: 100%;
}
</style>