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
        <label for="full_name">Your Name</label>
        <br>
        <TextInput class="layout" id="full_name" type="text" v-model="form.full_name" required autocomplete="name" />
        <br>
        <label for="email">Your email</label>
        <br>
        <TextInput class="layout" id="email" type="email" v-model="form.email" required autocomplete="name" />
        <br>
        <label for="text">Message text</label>
        <br>
        <textarea class="layout" id="text" v-model="form.text"></textarea>
        <br>
        <input class="_button _blue" type="submit" value="Send a Message">
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