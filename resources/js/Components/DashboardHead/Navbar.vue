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
        class="d-flex justify-content-between navbar-expand-lg navbar-light bg-white border border-bottom border-secondary-subtle fixed-top">
        <!-- Primary Navigation Menu -->
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between" style="height: 60px;">
                <div class="d-flex">
                    <!-- Logo -->
                    <div class="d-flex align-items-center">
                        <a class="navbar-brand" :href="route('dashboard')">
                            <ApplicationLogo class="d-block" style="height: 40px;" />
                        </a>
                        <a class="navbar-brand text-light fs-5" href="#">BDevelopers</a>
                    </div>

                </div>
                <!-- Navigation Links -->
                <div class="d-flex  align-items-center px-4 text-light">
                    <a v-if="!route().current('dashboard')" class="nav-link pe-4"
                        :class="{ active: route().current('dashboard') }" :href="route('dashboard')">
                    Dashboard
                </a>
                <a class="nav-link text-light" :href="route('index')" method="get">
                    Index
                </a>
                </div>
                <div class="d-sm-flex align-items-sm-center">
                    <!-- Settings Dropdown -->
                    <div class="ml-3 dropdown">
                        <a class="btn dropdown-toggle text-light border-0" href="#" role="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $page.props.auth.user.name }}
                            <!-- <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                                                                        fill="currentColor">
                                                                                                                        <path fill-rule="evenodd"
                                                                                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                                                                            clip-rule="evenodd" />
                                                                                                                    </svg> -->
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

                <!-- Hamburger -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
            class="navbar-expand-sm navbar-light bg-light d-block d-sm-none">
            <div class="pt-2 pb-3">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')"
                            class="nav-link">
                            Dashboard
                        </ResponsiveNavLink>
                    </li>
                </ul>
            </div>
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-top border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">
                        {{ $page.props.auth.user.name }}
                    </div>
                    <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                </div>

                <ul class="navbar-nav mt-3">
                    <li class="nav-item">
                        <ResponsiveNavLink :href="route('profile.dev.create')" class="nav-link">
                            Developer Settings
                        </ResponsiveNavLink>
                    </li>
                    <li class="nav-item">
                        <ResponsiveNavLink :href="route('profile.edit')" class="nav-link">
                            Profile
                        </ResponsiveNavLink>
                    </li>
                    <li class="nav-item">
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="nav-link">
                            Log Out
                        </ResponsiveNavLink>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style lang="scss" scoped>
@use 'resources/sass/variable.scss' as *;

nav {
    background-color: $brand_fourth;
}
</style>