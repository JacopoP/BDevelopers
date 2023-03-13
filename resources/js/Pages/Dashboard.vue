<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';



const props = defineProps([
    'developer',
]);




const data = {
    name: props.developer.user.name,
    last: props.developer.user.last,
    address: props.developer.address,
    profile_path: props.developer.profile_path,
};

</script>

<template>
    <h1>Your profile</h1>
    <div>
        {{ data.name }}
    </div>
    <div class="container">

    </div>
</template>


<style>
body {
    background-color: #212529;
}

h1 {
    color: white;
}
</style>