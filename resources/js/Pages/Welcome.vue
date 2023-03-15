<script>
// Inertia
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

// BDevelopers
import Navbar from '@/Components/Navbar.vue';

export default {
    name: 'LandingPage',

    components: {
        Head,
        Link,
        Navbar,
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

        <!-- Navbar -->
        <Navbar />

        <!-- HeroSection -->
        <div class="hero-section">
            <div class="container">
                <div class="row align-items-center justify-content-center" style="height: 100vh;">
                    <div class="col-md-6">
                        <h1 class="text-center mb-4">Start your research</h1>
                        <form class="form-inline d-flex justify-content-center">
                            <div class="form-group d-flex">

                                <input type="text" class="form-control form-control-lg mr-3" placeholder="Search..."
                                    v-model="form.name">
                                <select v-model="form.tech" class="text-dark">
                                    <option class="text-dark" v-for="tech in technologies" :value="tech.id">{{ tech.name }}</option>
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



