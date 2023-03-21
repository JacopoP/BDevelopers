<script setup>
import { ref } from 'vue';
import Navbar from '@/Components/DashboardHead/Navbar.vue';
import Footer from '@/Components/Footer/Footer.vue';
defineProps(['reloadNavbar']);
</script>


<template>
    <div class="bg-dark" style="min-height: 100vh;">
        <!-- <div class="pb-5 bg-dark"> -->
        <Navbar v-if="reloadNavbar || reloadNavbar == null"/>
        <!-- SubNavbar -->
        <header class="bg-dark text-light shadow py-3" style="margin-top: 60px;" v-if="$slots.header">
            <div class="container py-6 px-4">
                <slot name="header" />
            </div>
        </header>



        <!-- Page Content -->
        <main>
            <slot name="main" />
        </main>
        <Footer />

    </div>
</template>
