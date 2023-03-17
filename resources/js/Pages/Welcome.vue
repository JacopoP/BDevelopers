<script>
// Inertia
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

// BDevelopers
import ProfilesBackground from '@/Components/ProfilesBackground.vue';
import Navbar from '@/Components/Navbar.vue';

export default {
    name: 'LandingPage',

    components: {
        Head,
        Link,
        Navbar,
        ProfilesBackground
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        technologies: Array,
        developers: Object,
    },
    data() {
        return {
            form: {
                name: '',
                tech: null,
            }
        }
    },
    methods: {
        goToIndex: function () {
            axios.get('http://localhost:8000/index', this.form)
                .then((res) => console.log(res));
        }
    },
    mounted() {

    }
}
</script>

<template>
    <Head title="Welcome" />
    <div class="landing-page">

        <!-- ProfilesBackground -->
        <ProfilesBackground :developers="developers" />

        <!-- Hero Section -->
        <div class="hero-section fixed-top">
            <div class="container">
                <div class="row justify-content-center" style="height: 100vh;">
                    <div class="col-md-7 d-flex align-items-center">

                        <div class="main-div">
                            <h1 class="text-center mb-4 text-light">Start your research</h1>
                            <form class="form-inline d-flex justify-content-center">

                                <div class="input-group">
                                    <div class="form-floating">
                                        <input id="searchInput" type="text"
                                            class="<!-- form-control form-control-lg --> mr-3" placeholder="Type a name"
                                            v-model="form.name">
                                        <label for="searchInput">Search by name</label>
                                    </div>
                                    <div class="form-floating">
                                        <select id="techInput" v-model="form.tech" class="form-control form-select"
                                            aria-label="Floating label select example">
                                            <option :value="null" selected>Any</option>
                                            <option v-for="tech in technologies" :value="tech.id">{{
                                                tech.name
                                            }}
                                            </option>
                                        </select>
                                        <label for="techInput">Technology</label>
                                    </div>
                                </div>

                                <Link href="/index" method="post" :data="this.form" as="button"
                                    class="btn btn-lg btn-primary ml-2"> Go </Link>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <Navbar />

    </div>
</template>

<!-- Sponsor Section -->
        <!-- <div class="sponsor-section">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex justify-content-center flex-wrap gap-2">

                            <div v-for="(developer, index) in developers" class="card text-white bg-dark" style="width: 18rem;">
                                <img v-if="developer.profile_path" class="card-img-top" :src="developer.profile_path"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ developer.user.name }} {{ developer.user.last }}</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                        of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->
  
<style lang="scss" scoped>
// Define custom styles for the landing page
.landing-page {

    background-color: #1d1d1d;
    color: snow;

    .hero-section {

        // background-color: #1d1d1d16;
        backdrop-filter: blur(2px);

        .main-div {
            background-color: rgba(0, 0, 0, .5);
            border-radius: 20px;
            padding: 1rem;

            h1 {
                font-size: 3rem;
                font-weight: bold;
            }

            form {
                button {
                    background-color: #ff6769;
                    border-color: #ff6769;

                    &:hover {
                        background-color: darken(#ff6769, 10%);
                        border-color: darken(#ff6769, 10%);
                    }
                }
            }
        }
    }
}
</style>



