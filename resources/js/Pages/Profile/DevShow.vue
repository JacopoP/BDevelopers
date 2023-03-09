<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

// tentativo di importare l'array "dato"
const props = defineProps([
    'developer'
]);

console.log(props);


const forms = useForm({
    name: props.developer.user.name,
    last: props.developer.user.last,
    address: props.developer.address,

});


</script>
    
<template>
    <h1>Developers</h1>
    <ul>
        <li>Cognome: {{ forms.last }}</li>
        <li>Nome: {{ forms.name }}</li>
        <li>Indirizzo: {{ forms.address }}</li>
    </ul>
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