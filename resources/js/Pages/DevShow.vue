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
            <img class="profile me-2" :src="'storage/' + dati.profile_path">
        </div>

    </div>

    <!-- contatti -->
    <div class="container-fluid">
        <div class="d-flex justify-between _contact">

            <div class="d-flex">
                <img class="img_profile" :src="'storage/' + dati.profile_path">
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
                        <h3>URL Portfolio</h3>
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a href="#ancor" class="_blue">Send a Message, Leave a Reviews or a Star</a>
            </div>
        </div>
        <div class="_line _blue mt-4 "></div>

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

    <div>{{ dati.text }} </div>


    <!-- reviews e ratings -->
    <div class="container-fluid d-flex justify-content-evenly _contact mt-5">
        <div class="text">
            <h3><a id="ancor"></a> Review</h3>
            <ReviewForm :developer="developer" />
        </div>
        <div class="text">
            <h3 class="pt-3">Rating</h3>
            <RatingForm :developer="developer" />
        </div>
        <div class="text">
            <h3>Message</h3>
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

a {
    color: $titles;
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