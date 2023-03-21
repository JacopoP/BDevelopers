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
                    <div class="col col-md-7">

                        <div class="main-div rounded">
                            <h1 class="text-center mb-4 text-light">Start here!</h1>
                            <form class="form-inline d-flex justify-content-center gap-2">

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
                                    class="btn btn-lg btn-primary color-block sunny-morning-gradient"> Go </Link>
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
  
<style lang="scss" scoped>
// Define custom styles for the landing page
.landing-page {

    background-color: #121212;

    .hero-section {
        padding-top: 10rem;
        pointer-events: none;

        // background-color: #1d1d1d16;
        // backdrop-filter: blur(.6px);

        .main-div {
            pointer-events: auto;
            background-color: rgba(0, 0, 0, .5);
            backdrop-filter: blur(2px);
            // border-radius: 20px;
            padding: 1rem;

            h1 {
                font-size: 3rem;
                font-weight: bold;
            }

            form {
                button {
                    border-color: #E8763D;
                    // border: none;
                    background-image: linear-gradient(45deg,
                            hsl(357deg 76% 56%) 0%,
                            hsl(2deg 80% 58%) 11%,
                            hsl(7deg 84% 58%) 22%,
                            hsl(12deg 88% 58%) 33%,
                            hsl(16deg 91% 57%) 44%,
                            hsl(20deg 94% 57%) 56%,
                            hsl(23deg 97% 56%) 67%,
                            hsl(27deg 98% 55%) 78%,
                            hsl(30deg 99% 54%) 89%,
                            hsl(34deg 100% 53%) 100%);

                    &:hover {
                        border-color: darken(#E8763D, 10%);
                        background-image: linear-gradient(45deg,
                                hsl(357deg 76% 56%) 1%,
                                hsl(2deg 80% 58%) 35%,
                                hsl(7deg 84% 58%) 43%,
                                hsl(12deg 88% 58%) 47%,
                                hsl(16deg 91% 57%) 49%,
                                hsl(20deg 94% 57%) 50%,
                                hsl(23deg 97% 56%) 52%,
                                hsl(27deg 98% 55%) 56%,
                                hsl(30deg 99% 54%) 63%,
                                hsl(34deg 100% 53%) 99%);
                    }
                }
            }
        }
    }
}
</style>



