<script setup>
import { ref } from 'vue';
import Navbar from '@/Components/DashboardHead/Navbar.vue';
</script>

<template>
    <div>
        <div class="pb-5 bg-dark">
            <Navbar/>
            <!-- SubNavbar -->
            <header class="bg-dark text-light shadow" v-if="$slots.header">
                <div class="container py-6 px-4">
                    <slot name="header" />
                </div>
            </header>



            <!-- Page Content -->
            <main>
                <slot name="main" />
            </main>

        </div>
    </div>
</template>
