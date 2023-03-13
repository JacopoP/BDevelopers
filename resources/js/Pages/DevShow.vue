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
    <!-- intestazione -->
    <div class="d-flex justify-content-end _nav _rosa">

        <div class="d-flex">
            <h1 class="name pe-2">{{ dati.last }} {{ dati.name }}</h1>
            <img class="profile me-2" :src="dati.profile_path">
        </div>

    </div>

    <div class="container-fluid">
        <!-- sotto -->
        <div class="d-flex justify-between _contact">

            <div class="d-flex">
                <img class="img_profile" :src="dati.profile_path">
                <div class="d-flex flex-column justify-content-end ps-2">
                    <h3>Address:</h3>
                    <div class="text">
                        {{ dati.address }}
                    </div>
                    <h3> Phone Number:</h3>
                    <div class="text">
                        {{ dati.phone_number }}
                    </div>
                    <a :href="dati.portfolio_url" v-if="dati.portfolio_url">
                        <h3>Portfolio</h3>
                    </a>
                </div>
            </div>

            <div>
                <button class="_blue">Send a Message</button>
                <br>
                <button class="_rosa">Leave a reviews or a star</button>
            </div>
        </div>

        <div class="_contact">
            <div class="d-flex justify-content-between mt-4">
                <div class="text">{{ dati.about_me }}</div>
                <h3>"About me"</h3>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <h3>"Curriculum"</h3>
                <div class="text">{{ dati.cv_path }}</div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <div class="text">{{ dati.performances }}</div>
                <h3>"My Performances"</h3>
            </div>
        </div>

    </div>


    <!-- reviews e ratings -->
    <div>
        <h3>Review</h3>
        <div class="text">
            <ReviewForm :developer="developer" />
        </div>
        <h3>Rating</h3>
        <div class="text">
            <RatingForm :developer="developer" />
        </div>
    </div>
    <!-- Message -->
    <div>
        <h3>Message</h3>
        <div class="text">
            <MessageForm :developer="developer" />
        </div>
    </div>
</template>


<style lang="scss">
@use 'resources/sass/general.scss' as *;

body {
    background-color: $background;
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

button {
    color: $titles;
    padding: 10px;
    border-radius: 20px;
    margin-top: 15px;
}
</style>