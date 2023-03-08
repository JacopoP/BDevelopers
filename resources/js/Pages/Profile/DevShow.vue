<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

// tentativo di importare l'array "dato"
const props = defineProps([
    'message',
    'review',
    'rating',
    'developer'
]);

console.log(props);


const form = useForm({
    address: props.developer.address,

});


</script>
    
<template>
    <h1>qualcosa</h1>
    <!-- non funzionante -->
    <div>{{ form.address }}</div>
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