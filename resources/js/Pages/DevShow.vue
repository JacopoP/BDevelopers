<script setup>
import { useForm } from '@inertiajs/vue3';
import ReviewForm from '@/Pages/ShowComponents/ReviewForm.vue'
import MessageForm from '@/Pages/ShowComponents/MessageForm.vue'
import RatingForm from '@/Pages/ShowComponents/RatingForm.vue'
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
    <div class="d-flex flex-column">
        <!-- intestazione -->
        <div class="DEBUG-green d-flex">
            <div class="container-img">
                <img :src="dati.profile_path">
            </div>
            <div class="DEBUG-blue nome-cognome">
                <h1>{{ dati.last }} {{ dati.name }}</h1>

            </div>
        </div>


        <!-- sotto -->
        <div class="d-flex justify-between">

            <div>
                <b>About me</b>
                <div>{{ dati.about_me }}</div>
                <b>My Performances</b>
                <div>{{ dati.performances }}</div>
            </div>
            <div>
                <b>details</b>
                <div>{{ dati.address }}</div>
                <div>{{ dati.phone_number }}</div>
                <!-- se non c'è il portfolio non metto il link -->
                <a :href="dati.portfolio_url" v-if="dati.portfolio_url">Portfolio</a>


                <!-- cv_path? -->
            </div>

        </div>


        <!-- reviews e ratings -->
        <h2>Review</h2>
        <ReviewForm :developer="developer" />
        <br>
        <h2>Rating</h2>
        <RatingForm :developer="developer" />
        <br>
        <h2>Message</h2>
        <MessageForm :developer="developer" />
    </div>
</template>

<style lang="scss">
@use 'resources/sass/general.scss' as *;

$background: #26292d;
$name: #ffffff;
$titles: #ffee00;
$w-container-img: 150px;

body {
    background-color: $background;
    color: $name;
    padding: 20px;
}


.container-img {
    display: flex;
    justify-content: center;
    align-items: center;
    width: $w-container-img;

    img {
        width: $w-container-img * 0.7;
        height: $w-container-img * 0.7;
        object-fit: cover;
        border-radius: 20px;
    }
}

.nome-cognome {
    width: calc(100% - $w-container-img);
}

h2 {

    color: $titles;
}


.my_input {
    border-radius: 30px;
    padding: 10px 20px;
}


// debug
.DEBUG-green {
    background-color: rgba(0, 128, 0, 0.087);
}

.DEBUG-blue {
    background-color: rgba(0, 0, 255, 0.053);
}

.DEBUG-yellow {
    background-color: rgba(238, 255, 0, 0.053);
}
</style>