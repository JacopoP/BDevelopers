<script setup>
import { Head } from '@inertiajs/vue3';
import GuestNavbar from '@/Components/WelcomeHead/Navbar.vue';

const props =defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    technologies: Array,
    developers: Object,
});

console.log(props);
</script>

<template>
    <Head title="Welcome" />
    <GuestNavbar :canLogin="canLogin" :canRegister="canRegister" :laravelVersion="laravelVersion" :phpVersion="phpVersion"/>
</template>



