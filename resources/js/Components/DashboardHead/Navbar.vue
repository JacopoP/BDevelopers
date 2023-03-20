<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

</script>

<template>
    
    <nav
        class="container-fluid my_register_button d-flex justify-content-between navbar-expand-lg navbar-light border-secondary-subtle fixed-top">

        <!-- Primary Navigation Menu -->
        <div class="container">
            <div class="d-flex justify-content-between" style="height: 60px;">
                <div class="d-flex">
                    <!-- Logo -->
                    <div class="d-flex align-items-center">
                        <a :href="route('home')">
                            <ApplicationLogo class="d-block" style="height: 40px;" />
                        </a>
                        <a class="d-none d-lg-flex text-light fs-5" :href="route('home')">BDevelopers</a>
                    </div>

                </div>

                <!-- Dashboard & Index -->
                <div class="d-flex align-items-center gap-3 text-light">
                    <a v-if="!route().current('dashboard')" class="nav-link"
                        :class="{ active: route().current('dashboard') }" :href="route('dashboard')">
                        Dashboard
                    </a>
                    <a v-if="!route().current('index')" class="nav-link text-light"
                        :class="{ active: route().current('index') }" :href="route('index')" method="get">
                        Index
                    </a>
                </div>

                <div class="d-flex align-items-center" v-if="$page.props.auth.user != undefined">
                    <!-- Settings Dropdown -->
                    <div class="dropdown">
                        <a class="btn dropdown-toggle text-light border-0" href="#" role="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $page.props.auth.user.name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" :href="route('profile.dev.create')">
                                    Developer Settings
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" :href="route('profile.edit')">Profile</a>
                            </li>
                            <li>
                                <NavLink class="dropdown-item px-3" :href="route('logout')" method="post">
                                    Logout
                                </NavLink>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-sm-flex align-items-sm-center gap-3" v-else>
                    <Link class="text-light text-decoration-none" :href="route('login')">Login</Link>
                    <Link class="text-light text-decoration-none" :href="route('register')">Register</Link>
                </div>

            </div>
        </div>

    </nav>

</template>

<style lang="scss" scoped>
@use 'resources/sass/form-style.scss' as *;
</style>