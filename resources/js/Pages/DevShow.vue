<script setup>
import { useForm } from '@inertiajs/vue3';
import ReviewForm from '@/Pages/ShowComponents/ReviewForm.vue'
import MessageForm from '@/Pages/ShowComponents/MessageForm.vue'
import RatingForm from '@/Pages/ShowComponents/RatingForm.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue';


const props = defineProps([
    'developer',
]);

const dati = {
    name: props.developer.user.name,
    last: props.developer.user.last,
    address: props.developer.address,
    phone_number: props.developer.phone_number,
    profile_path: props.developer.profile_path
        ? props.developer.profile_path
        : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png",
    cv_path: props.developer.cv_path,
    portfolio_url: props.developer.portfolio_url,
    about_me: props.developer.about_me,
    performances: props.developer.performances,
    reviews: props.developer.reviews,

};

const form = useForm({
    text: null,
    full_name: null,
});

function submit() {
    if (form.text !== null) {
        form.post(route('review.store', props.developer.id))
    }
}

</script>
    
<template>
    <!-- Navbar -->
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
                    <li class="nav-item">
                        <a class="nav-link" :href="route('index')" method="get">
                            Index
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- contacts -->
    <div class="container-fluid">
        <div class="d-flex justify-between _contact">

            <div class="d-flex">
                <img class="img_profile" :src="'storage/' + dati.profile_path">
                <div class="d-flex flex-column justify-content-end ps-2">
                    <h3 class="text-light">Address:</h3>
                    <div class="text-light">
                        {{ dati.address }}
                    </div>
                    <h3 class="text-light"> Phone Number:</h3>
                    <div class="text-light">
                        {{ dati.phone_number }}
                    </div>
                    <a :href="dati.portfolio_url" v-if="dati.portfolio_url">
                        <h3 class="text-light">Vai al mio Portfolio</h3>
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a href="#ancor" class="_blue text-light">Send a Message, Leave a Reviews or a Star</a>
            </div>
        </div>

        <!-- Curriculum etc... -->
        <div class="_line _blue mt-4 "></div>
        <div class="_contact">
            <div class="d-flex justify-content-between mt-4">
                <div class="text-light">{{ dati.about_me }}</div>
                <h3 class="text-light">"About me"</h3>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <h3 class="text-light">"Curriculum"</h3>
                <div class="text-light">{{ dati.cv_path }}</div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div class="text-light">{{ dati.performances }}</div>
                <h3 class="text-light">"My Performances"</h3>
            </div>

        </div>

        <div class="_line _blue mt-4 "></div>

        <!-- Reviews -->
        <div class="text-center _contact">
            <h3 class="text-light">My Reviews</h3>
            <ul class="text text-light">
                <li v-for="review in dati.reviews">
                    {{ review.text }}
                </li>
            </ul>
        </div>

        <div class="_line _blue mt-4 "></div>

    </div>


    <!-- reviews, ratings e message send -->
    <div class="container-fluid d-flex justify-content-evenly _contact mt-5">
        <div>
            <h3 class="text-light"><a id="ancor"></a> Review</h3>
            <ReviewForm :developer="developer" />
        </div>
        <div>
            <h3 class="pt-3 text-light">Rating</h3>
            <RatingForm :developer="developer" />
        </div>
        <div>
            <h3 class="text-light">Message</h3>
            <MessageForm :developer="developer" />
        </div>
    </div>
</template>


<style lang="scss">
// @use 'resources/sass/variable.scss' as *;
@use 'resources/sass/devShow-layout-style.scss' as *;

body {
    background-color: $brand_background;
}

nav {
    background-color: $brand_fourth;
}

// Menù nav
img.profile {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 20px;
}

// Contacts part 
div._contact {
    width: 80%;
    margin: 0 auto;
    padding-top: 20px;
}

img.img_profile {
    width: 400px;
}

a {
    color: $brand_secondary;
    padding: 10px;
    border-radius: 20px;
    // margin-top: 15px;
    text-decoration: none;
}


._line {
    width: 80%;
    margin: 0 auto;
    height: 2px;
}
</style>