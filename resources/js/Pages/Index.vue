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
            nameFilter: this.data.name != undefined ? this.data.name : '',
            post: {
                nFilter: '',
                lFilter: '',
                ratingFilter: 0,
                reviewFilter: 0,
                techFilter: [],
            },
            isActive: false,
        }
    },
    methods: {
        goFilter: function () {
            let textArray = this.nameFilter.split(' ');
            this.post.nFilter = textArray[0];
            if (textArray.length >= 1) { textArray.shift() };
            this.post.lFilter = textArray.join(' ');
            let params = this.post;

            axios.get(api + 'search', { params })
                .then((res) => {
                    this.developers = res.data.response.developers
                })
                .catch((err) => console.log(err));
        },

    },
    mounted() {
        if (this.data.tech != undefined) {
            this.post.techFilter.push(this.data.tech)
        }
        this.goFilter();
    }
}
</script>

<template>
    <AuthenticatedLayout>

        <template #main>
            
            <div class="results-page">
        
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
                                        <select class="form-control border border-0 rounded-pill" v-model="this.post.ratingFilter" id="raitingFilter">
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
                                        <select class="form-control border border-0 rounded-pill" v-model="this.post.reviewFilter" id="raitingFilter">
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
                            <div class="d-flex gap-2 text-light">
                                <div v-for="(technology, index) in this.technologies" :key="index" class="d-flex gap-1 align-items-center">

                                    <input class="d-none" :id="'techFilter[]' + index" type="checkbox" v-model="this.post.techFilter" :value="technology.id">

                                    <label class="my_register_button btn rounded-pill" :class="{'text-light': this.post.techFilter.includes(technology.id)}" :for="'techFilter[]' + index ">{{ technology.name }}
                                    </label>
                                </div>
                            </div>
        
                            <!-- Submit -->
                            <input type="submit" value="Filter" class="btn btn-primary my-4">
                        </div>
        
                    </form>
                </div>
        
                <!-- Results -->
                <div class="results">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                            <div class="col" v-for="developer in this.developers">
                                <div class="card mb-4 position-relative">
                                    <div class="card-header">{{ developer.user.name }} {{ developer.user.last }}</div>
                                    <div class="card-body">
                                        <!-- <div class="mb-2"><strong>Skills:</strong> {{ developer.skills.join(', ') }}</div> -->
                                        <div class="text-truncate mb-2"><strong>Mail:</strong> {{ developer.user.email }}</div>

                                        <div class="text-truncate">
                                            <span v-for="tech in developer.technologies">{{ tech.name }}&nbsp;</span>
                                        </div>
        
                                        <!-- <div class="mb-2"><strong>Rating:</strong> {{ developer.rating }} stars</div> -->
                                        <!-- <div class="mb-2"><strong>Reviews:</strong> {{ developer.reviews }} reviews</div> -->
                                        <div class="my_image_position img">
                                            <img class="my_profile_img" :src="'storage/' + developer.profile_path" alt="">
                                        </div>
                                        <!-- {{ developer.user.name }} {{ developer.user.last }} <br> -->
                                        <br>
                                        <Link :href="'/show' + developer.id" class="btn btn-outline-primary rounded-pill">
                                            Profilo
                                        </Link>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
</style>