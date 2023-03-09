<script setup>
import { useForm } from '@inertiajs/vue3';
// tentativo di importare l'array "dato"
const props = defineProps([
    'developer',
]);

console.log(props);


const dati = {
    name: props.developer.user.name,
    last: props.developer.user.last,
    address: props.developer.address,
    profile_path: props.developer.profile_path,
};

const form = useForm({
    text: null,
    full_name: null,
});

function submit() {
    // if (form.text !== null) {
    form.post(route('review.store', props.developer.id))
    // }
}

</script>
    
<template>
    <h1>Developers</h1>
    <ul>
        <li>Cognome: {{ dati.last }}</li>
        <li>Nome: {{ dati.name }}</li>
        <li>profile_path: {{ dati.profile_path }}</li>
    </ul>

    <form method="post" @submit.prevent="form.post(route('review.store', developer.id))">
        <label for="text">review</label>
        <br>
        <textarea id="text" v-model="form.text"></textarea>
        <br>
        <label for="full_name">If u want to add your name</label>
        <br>
        <input type="text" v-model="form.full_name">
        <input type="submit">
    </form>
</template>

<style lang="scss">
@use 'resources/sass/general.scss' as *;

.test {
    color: $brand_primary;
}

.my_input {
    border-radius: 30px;
    padding: 10px 20px;
}
</style>