<script>
import ApplicationLogo from '../Components/ApplicationLogo.vue';
// AuthenticatedLayout
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
import { Link } from '@inertiajs/vue3';
const apiUrl = 'http://localhost:8000/api/';
const apiVersion = 'v1/';
const api = apiUrl + apiVersion;

export default {
    components: {
        Link,
        ApplicationLogo,
        AuthenticatedLayout,
    },
    props: ['technologies', 'data'],
    data() {
        return {
            name: 'IndexPage',
            developers: [],
            pageShow: 1,
            pageN: 0,
            nameFilter: this.data.name != undefined ? this.data.name : '',
            ratingFilter: 0,
            reviewFilter: 0,
            techFilter: [],
            isLoading: false,
            post: {
                nFilter: '',
                lFilter: '',
                ratingFilter: 0,
                reviewFilter: 0,
                techFilter: [],
            },
            isActive: false,
            defaultImg: 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png',
        }
    },
    methods: {
        goFilter: function () {
            this.isLoading=true;
            let textArray = this.nameFilter.split(' ');
            this.post.nFilter = textArray[0];
            if (textArray.length >= 1) { textArray.shift() };
            this.post.lFilter = textArray.join(' ');
            this.post.ratingFilter = this.ratingFilter;
            this.post.reviewFilter = this.reviewFilter;
            this.post.techFilter = this.techFilter;

            const params = {
                post: this.post,
                page: 1,
            }

            axios.get(api + 'search', { params })
                .then((res) => {
                    this.developers = res.data.response.developers.data;
                    this.pageN = res.data.response.developers.last_page;
                    this.pageShow=1;
                    this.isLoading=false;
                })
                .catch((err) => console.log(err));
        },

        nextPage: function(){
            this.pageShow++;
            this.isLoading=true;

            const params = {
                post: this.post,
                page: this.pageShow,
            }

            axios.get(api + 'search', { params })
                .then((res) => {
                    this.developers = this.developers.concat(res.data.response.developers.data);
                    this.isLoading=false;
                })
                .catch((err) => console.log(err));
        }

    },
    mounted() {
        if (this.data.tech != undefined) {
            this.techFilter.push(this.data.tech)
        }
        this.goFilter();
    }
}
</script>

<template>
    <AuthenticatedLayout>

        <template #header>
            <h2>
                Index
            </h2>
        </template>
        <template #main>
            
            <div class="results-page pt-5">
        
                <!-- Filters -->
                <div class="filters">
                    <form @submit.prevent="goFilter">
        
                        <div class="container">
                            <div class="row justify-content-between gap-5 pt-4">
        
                                <!-- filter by name -->
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-inline">
                                        <label for="nameFilter" class="my_register_button text-light rounded-pill px-2 py-0">Search Name</label>
                                    </div>
                                    <input type="text" v-model="this.nameFilter" name="nameFilter" placeholder="Search name..." class="rounded-pill border border-0 p-2 px-4">
                                </div>
        
                                <!-- filter by rating -->
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="form-group d-flex flex-column gap-2">
                                        <div class="d-inline">
                                            <label for="min-rating" class="my_register_button text-light rounded-pill px-2 py-0">Minimum rating:</label>
                                        </div>
                                        <select class="form-control border border-0 rounded-pill" v-model="this.ratingFilter" id="raitingFilter">
                                            <option value="0">Any</option>
                                            <option v-for="n in 5" :value="n" :key="n">{{ n }} star{{ n !== 1 ? 's' : '' }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
        
                                <!-- filter by review -->
                                <div class="col-md-4">
                                    <div class="form-group d-flex flex-column gap-2">
                                        <div class="d-inline">
                                            <label for="min-reviews" class="my_register_button text-light rounded-pill px-2 py-0" >Minimum reviews:</label>
                                        </div>
                                        <select class="form-control border border-0 rounded-pill" v-model="this.reviewFilter" id="raitingFilter">
                                            <option value="0">Any</option>
                                            <option value="5">5+</option>
                                            <option value="10">10+</option>
                                            <option value="50">50+</option>
                                            <option value="100">100+</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <!-- filter by technology -->
                            <h2>Technology filter</h2>
                            <div class="d-flex gap-2 text-light flex-wrap">
                                <div v-for="(technology, index) in this.technologies" :key="index" class="d-flex gap-1 align-items-center">

                                    <input class="d-none" :id="'techFilter[]' + index" type="checkbox" v-model="this.techFilter" :value="technology.id">

                                    <label class="my_register_button btn rounded-pill" :class="{'text-light': this.techFilter.includes(technology.id)}" :for="'techFilter[]' + index ">{{ technology.name }}
                                    </label>
                                </div>
                            </div>
        
                            <!-- Submit -->
                            <input type="submit" value="Filter" class="btn btn-primary my-4">
                        </div>
        
                    </form>
                </div>
        
                <!-- Results -->
                <div class="results pb-5">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                            <div class="col" v-for="developer in this.developers">
                                <div class="my_login_button_2 text-light card mb-4 position-relative">
                                    <a :href="($page.props.auth.user != null && $page.props.auth.user.id == developer.id ? route('dashboard') : '/show' + developer.id)" class="nav-link card-header">{{ developer.user.name }} {{ developer.user.last }}</a>
                                    <div class="card-body">
                                        <!-- <div class="mb-2"><strong>Skills:</strong> {{ developer.skills.join(', ') }}</div> -->
                                        <div class="text-truncate mb-2"><strong>Mail:</strong> {{ developer.user.email }}</div>

                                        <div class="text-truncate">
                                            <span v-for="tech in developer.technologies">{{ tech.name }}&nbsp;</span>
                                        </div>
        
                                        <!-- <div class="mb-2"><strong>Rating:</strong> {{ developer.rating }} stars</div> -->
                                        <!-- <div class="mb-2"><strong>Reviews:</strong> {{ developer.reviews }} reviews</div> -->
                                        <a :href="($page.props.auth.user != null && $page.props.auth.user.id == developer.id ? route('dashboard') : '/show' + developer.id)" class="my_image_position img">
                                            <img class="my_profile_img" :src="developer.profile_path !== null ? ('storage/' + developer.profile_path) : defaultImg" alt="">
                                        </a>
                                        <!-- {{ developer.user.name }} {{ developer.user.last }} <br> -->
                                        <br>
                                        <Link :href="($page.props.auth.user != null && $page.props.auth.user.id == developer.id ? route('dashboard') : '/show' + developer.id)" class="btn btn-outline-primary rounded-pill">
                                            Profile
                                        </Link>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="d-block btn next_page_btn my_login_button_2 mt-2 mx-auto text-light px-3 py-1 border border-light" v-if="this.pageShow < this.pageN && !this.isLoading" @click="this.nextPage()">More results</button>
                </div>
        
            </div>

        </template>

    </AuthenticatedLayout>


</template>

<style lang="scss" scoped>
@use '../../../resources/sass/form-style.scss' as *;

nav {
    background-color: $brand_fourth;
}

ul {
    list-style: none;
}

img{
    width: 100%;
}
.my_profile_img{
    width: 100px;
    height: 100px;
    border-radius: 100%;
    object-fit: cover;
}

.my_image_position{
    position: absolute;
    top: -20px;
    right: 20px;
}

.next_page_btn{
    width: fit-content;
    border-radius: 50px;
    opacity: .7;
    &:hover{
        opacity: 1;
    }
}
</style>