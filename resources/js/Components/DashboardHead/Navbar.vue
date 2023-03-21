<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted } from 'vue';

const showingNavigationDropdown = ref(false);

</script>

<script>
    const link = 'http://localhost:8000/api/v1/';
export default{
    data(){
        return{
            imgPath: '',
            defaultImg: 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png',
        }
    },
    mounted(){
        if(usePage().props.auth.user !== null){
            axios.get(link + 'profile_path' + usePage().props.auth.user.id)
            .then((res) => {this.imgPath = res.data.response.path})
            .catch((error) => console.log(error))
        }
    }
}
</script>

<template>
    
    <nav
        class="container-fluid my_register_button d-flex justify-content-between navbar-expand-lg navbar-light border-secondary-subtle fixed-top">

        <!-- Primary Navigation Menu -->
        <div class="container">
            <div class="d-flex justify-content-between align-items-center" style="height: 60px;">
                <div class="d-flex">
                    <!-- Logo -->
                    <div class="d-flex align-items-center">
                        <a :href="route('home')">
                            <ApplicationLogo class="d-block" style="height: 40px;" />
                        </a>
                        <a class="d-none d-lg-flex text-light fs-5 nav-link fw-bold" :href="route('home')">BDevelopers</a>
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
                        
                        <a class="d-flex flex-column align-items-center btn text-light border-0" href="#" role="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                            <div style="width: 50px;">
                                <img class="rounded-circle" :src="imgPath !== null ? ('storage/' + imgPath) : defaultImg">
                            </div>
                            <!-- <a class="dropdown-toggle text-light nav-link" style="font-size: 10px;">
                                <span>
                                    {{ $page.props.auth.user.name }}
                                </span>
                            </a> -->
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
                <div class="d-flex align-items-sm-center gap-2" v-else>
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