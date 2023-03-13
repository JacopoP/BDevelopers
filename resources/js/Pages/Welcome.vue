<script setup>
import { Head } from '@inertiajs/vue3';
import GuestNavbar from '@/Components/WelcomeHead/Navbar.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

</script>

<template>
    <!-- Meta -->
    <Head title="Landing" />

    <!-- default view -->
    <!-- <GuestNavbar :canLogin="canLogin" :canRegister="canRegister" :laravelVersion="laravelVersion" :phpVersion="phpVersion"/> -->

    <div id="LandingPage">
        <h1>
            Landing Page
        </h1>
    </div>
</template>

<style lang="scss">
#LandingPage{

    // Full viewport size
    height: 100vh;

    // Defaults
    background-color: #1d1d1d;
    color: snow;
}
</style>



