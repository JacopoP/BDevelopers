<script>
import ApplicationLogo from '../Components/ApplicationLogo.vue';

import axios from 'axios';
import { Link } from '@inertiajs/vue3';
const apiUrl = 'http://localhost:8000/api/';
const apiVersion = 'v1/';
const api = apiUrl + apiVersion;

export default {
    components: {
        Link,
        ApplicationLogo,
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
            }
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
        }
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
    <div class="results-page">

        <!-- NavBar -->

        <nav class="navbar navbar-expand-lg navbar-dark">

            <div class="container">

                <!-- BDevelopers logo + title -->
                <div class="d-flex">
                    <ApplicationLogo class="d-block" style="height: 40px;" />

                    <a class="navbar-brand" href="#">BDevelopers</a>
                </div>

                <!-- Nav -->
                <div id="navbarNav">
                    <ul class="navbar-nav ml-auto list-unstyled d-flex flex-row gap-2">
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main -->
        <main>

            <!-- Filters -->
            <div class="filters">
                <form @submit.prevent="goFilter">

                    <div class="container">
                        <div class="row justify-content-between">

                            <!-- filter by name -->
                            <label for="nameFilter">Name</label>
                            <input type="text" v-model="this.nameFilter" name="nameFilter" placeholder="name">

                            <!-- filter by rating -->
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="form-group">
                                    <label for="min-rating">Minimum rating:</label>
                                    <select class="form-control" v-model="this.post.ratingFilter" id="raitingFilter">
                                        <option value="">Any</option>
                                        <option v-for="n in 5" :value="n" :key="n">{{ n }} star{{ n !== 1 ? 's' : '' }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- filter by review -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="min-reviews">Minimum reviews:</label>
                                    <select class="form-control" v-model="this.post.reviewFilter" id="raitingFilter">
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
                    <div class="d-flex gap-2">
                            <div v-for="technology in this.technologies" class="d-flex gap-1 align-items-center">
                                <input type="checkbox" v-model="this.post.techFilter" :value="technology.id">
                                <label for="techFilter[]">{{ technology.name }}
                                </label>
                            </div>
                        </div>

                        <!-- Submit -->
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>

                </form>
            </div>

            <!-- Results -->
            <div class="results">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4" v-for="developer in this.developers">
                            <div class="card mb-4">
                                <div class="card-header">{{ developer.user.name }} {{ developer.user.last }}</div>
                                <div class="card-body">
                                    <!-- <div class="mb-2"><strong>Skills:</strong> {{ developer.skills.join(', ') }}</div> -->
                                    <div class="mb-2"><strong>Mail:</strong> {{ developer.user.email }}</div>
                                    <span v-for="tech in developer.technologies">{{ tech.name }}&nbsp;</span>

                                    <!-- <div class="mb-2"><strong>Rating:</strong> {{ developer.rating }} stars</div> -->
                                    <!-- <div class="mb-2"><strong>Reviews:</strong> {{ developer.reviews }} reviews</div> -->

                                    <!-- {{ developer.user.name }} {{ developer.user.last }} <br> -->
                                    <!-- {{ developer.user.email }} <br> -->
                                    <br>
                                    <Link :href="'/show' + developer.id" class="btn btn-outline-secondary">Visita la pagina
                                    </Link>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <br>
    <!-- <ul>
                                                                                                                                                    <li v-for="developer in this.developers">
                                                                                                                                                        {{ developer.user.name }} {{ developer.user.last }} <br>
                                                                                                                                                        {{ developer.user.email }} <br>
                                                                                                                                                        <span v-for="tech in developer.technologies">{{ tech.name }}&nbsp;</span> <br>
                                                                                                                                                        <Link :href="'/show' + developer.id">Visita la pagina</Link>
                                                                                                                                                        <hr>
                                                                                                                                                    </li>
                                                                                                                                                </ul> -->
</template>

<style lang="scss">
@use 'resources/sass/variable.scss' as *;

nav {
    background-color: $brand_fourth;
}

ul {
    list-style: none;
}
</style>