<script setup>
import { ref } from 'vue';
import Navbar from '@/Components/DashboardHead/Navbar.vue';
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <Navbar/>
            <!-- SubNavbar -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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
