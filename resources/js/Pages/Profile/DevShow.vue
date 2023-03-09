<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

// tentativo di importare l'array "dato"
const props = defineProps([
    'developer',
    'review'
]);

console.log(props);


const dati = {
    name: props.developer.user.name,
    last: props.developer.user.last,
    address: props.developer.address,
    profile_path: props.developer.profile_path,
    review: props.review.text,


};

const form = useForm({

    text: props.review.text,

});


</script>
    
<template>
    <h1>Developers</h1>
    <ul>
        <li>Cognome: {{ dati.last }}</li>
        <li>Nome: {{ dati.name }}</li>
        <li>profile_path: {{ dati.profile_path }}</li>
    </ul>

    <form action="" @submit.prevent="form.post(route('ReviewStore', 'id'))">
        <!-- 
                è vero ma attualmente non è molto determinante
            
                -->
        <label for="review">review</label>
        <br>
        <textarea name="review" v-model="dati.review"></textarea>
        <br>
        <input type="submit">
    </form>
    <div>review: {{ dati.review }}</div>
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