<script>
import { Head } from '@inertiajs/vue3';
import GuestNavbar from '@/Components/WelcomeHead/Navbar.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'LandingPage',

    components: {
        Head,
        GuestNavbar,
        Link,
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
    }
}
</script>

<template>
    <Head title="Welcome" />
    <div class="landing-page">

        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">

                <!-- BDevelopers logo + title -->
                <a class="navbar-brand" href="#">BDevelopers</a>

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

        <!-- HeroSection -->
        <div class="hero-section">
            <div class="container">
                <div class="row align-items-center justify-content-center" style="height: 100vh;">
                    <div class="col-md-8">
                        <h1 class="text-center mb-4">Start your research...</h1>
                        <form class="form-inline d-flex justify-content-center">

                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" placeholder="🔍 Search by name"
                                    v-model="form.name">
                                <select v-model="form.tech" class="form-select col-1">
                                    <option selected>any</option>
                                    <option class="text-dark dropdown-item" v-for="tech in technologies" :value="tech.id">{{
                                        tech.name }}</option>
                                </select>
                                <Link href="/index" method="post" :data="this.form" as="button"
                                    class="btn btn-lg btn-primary"> Go </Link>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sponsor -->
        <!-- work in progress -->

    </div>
</template>
  
<style lang="scss">
// Import Bootstrap SCSS
//   @import '~bootstrap/scss/bootstrap';

// Define custom styles for the landing page
.landing-page {
    .hero-section {
        background-color: #424242;
        color: #fff;

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
</style>



