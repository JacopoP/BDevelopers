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

        <!-- Navbar -->
        <Navbar />

        <!-- Hero Section -->
        <div class="hero-section fixed-top">
            <div class="container">
                <div class="row justify-content-center" style="height: 100vh;">
                    <div class="col-md-6 d-flex align-items-center">

                        <div class="main-div">
                            <h1 class="text-center mb-4">Start your research</h1>
                            <form class="form-inline d-flex justify-content-center">
                                <div class="form-group d-flex">

                                    <input type="text" class="form-control form-control-lg mr-3" placeholder="Search..."
                                        v-model="form.name">
                                    <select v-model="form.tech" class="text-dark">
                                        <option class="text-dark" v-for="tech in technologies" :value="tech.id">{{ tech.name
                                        }}
                                        </option>
                                    </select>
                                    <Link href="/index" method="post" :data="this.form" as="button"
                                        class="btn btn-lg btn-primary"> Go </Link>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

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

    background-color: snow;
    color: black;

    .hero-section {

        .main-div {
            background-color: rgba(0, 0, 0, 0.313);
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



