<script setup>
import { useForm } from '@inertiajs/vue3';
import ReviewForm from '@/Pages/ShowComponents/ReviewForm.vue'
import MessageForm from '@/Pages/ShowComponents/MessageForm.vue'
import RatingForm from '@/Pages/ShowComponents/RatingForm.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

// AuthenticatedLayout
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

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
    profile_path: null,
});

function submit() {
    if (form.text !== null) {
        form.post(route('review.store', props.developer.id))
    }
};

// PoP UP
// function myFunction() {
//     var popup = document.getElementById("myPopup");
//     popup.classList.toggle("show");
// }

</script>
    
<script>
export default {
  methods: {
    copyText(id) {
      const testoDaCopiare = document.querySelector(`#${id}`)
      navigator.clipboard.writeText(testoDaCopiare.innerText)
    }
  }
}
</script>

<template>
    <AuthenticatedLayout>

        <template #main>

            <!-- contacts -->
            <div class="container mt-5 py-5">

                <div class="position-relative d-flex justify-content-around align-items-center flex-column flex-lg-row gap-5">

                    <div class="d-flex flex-lg-row align-items-lg-center gap-lg-3 flex-column">
                        <div class="popup"
                            @click="myFunction()">
                            <img class="img_profile rounded-circle shadow " :src="'storage/' + dati.profile_path">
                            
                            <!-- PoP Up -->

                            <!-- <div class="my_popuptext my_login_button text-dark p-4 shadow" id="myPopup">
                                
                                <img class="img_profile rounded-circle shadow" :src="'storage/' + dati.profile_path">
                                <form class="d-flex justify-content-between" method="post" enctype="multipart/form-data"
                                    @submit.prevent="form.post(route('profile.dev.store'))">

                                    <div>
                                        Profile IMG
                                        <div class="mx-auto">
                                            <label for="profile_path"
                                                class="my_login_button_2 px-3 py-1 rounded-pill text-light btn btn-secondary border-0">Upload
                                                Image</label>
                                        </div>
                                        <input id="profile_path" class="form-control border-dark rounded-pill" type="file"
                                            name="profile_path" @input="form.profile_path = $event.target.files[0]">
                                        </div>
                                        
                                        Submit
                                        <div class="d-flex justify-content-center"
                                            v-if="form.address == null && form.phone_number == null && form.portfolio_url == null && form.about_me == null && form.performances == null">
                                            <input class="my_login_button_2 btn btn-secondary rounded-pill text-light border-0" type="submit"
                                                value="SEND">
                                        </div>
                                </form>

                            </div> -->

                            
                            
                        </div>
                        <!-- INFO -->
                        <div v-if="dati.address !== null || dati.phone_number !== null || dati.portfolio_url !==null" class="d-flex flex-column align-items-start gap-5">

                            <div class="d-flex flex-column align-items-start gap-3">
                                <div v-if="dati.address !== null" class="my_login_button d-flex align-items-center rounded px-3 py-2 gap-3" style="max-width: 350px;">
                                    <h5 class="text-light fs-6 w-50">Address:</h5>
                                    <p id="copyAddress" class="fs-6 text-secondary m-0 text-truncate">{{dati.address}}</p>

                                    <!-- Copy -->
                                    <button class="my_login_button btn btn-secondary text-light border-0" @click="copyText('copyAddress')">
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </div>
    
                                <div v-if="dati.phone_number !== null" class="my_login_button d-flex align-items-center rounded px-3 py-2 gap-3" style="max-width: 350px;">
                                    <h5 class="text-light fs-6 w-50"> Phone number:</h5>
                                    <p id="copyPhoneNumber" class="fs-6 text-secondary m-0 text-truncate">{{dati.phone_number}}</p>

                                    <!-- Copy -->
                                    <button class="my_login_button btn btn-secondary text-light border-0" @click="copyText('copyPhoneNumber')">
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <a class="btn btn-danger my_register_button border-0 rounded-pill text-light px-3 py-2" :href="dati.portfolio_url" v-if="dati.portfolio_url">
                                    Show my portfolio
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="#ancor" class="btn btn-primary rounded-pill my_login_button text-light">
                            Send a Message, Leave a
                            Reviews or a Star
                        </a>
                    </div>
                </div>

                <!-- Curriculum etc... -->
                <div class="_line my_login_button my-5 rounded-pill w-100" style="height: 3px;"></div>

                <div class="d-flex flex-column gap-4">
                    <div class="d-flex flex-column flex-lg-row justify-content-between mt-4">
                        <div class="order-2 order-lg-1 text-light">{{ dati.about_me }}</div>
                        <h3 class="order-1 order-lg-2 col-lg-3 text-light text-start text-lg-end">"About me"</h3>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <h3 class="col-3 text-light">"Curriculum"</h3>
                        <a class="btn btn-outline-secondary rounded-pill d-flex align-items-center"
                            :href="'storage/' + dati.cv_path" download>Download CV</a>
                    </div>
                    <div class="d-flex flex-column flex-lg-row justify-content-between mt-4">
                        <div class="order-2 order-lg-1 text-light">{{ dati.performances }}</div>
                        <h3 class="order-1 order-lg-2 col-lg-3 text-light text-start text-lg-end">"My Performances"</h3>
                    </div>

                </div>

                <div class="_line my_login_button mt-5 mb-3 rounded-pill w-100" style="height: 3px;"></div>

                <!-- Reviews -->
                <div class="d-flex flex-column align-items-center gap-4">
                    <h3 class="text-light">My Reviews</h3>
                    <ul class="text-light d-inline-flex gap-4 overflow-auto" style="max-width: 100%; min-height: 100px;">
                        <li v-for="review in dati.reviews" class="text-start card rounded _secondary py-3 px-5 shadow"
                            style="min-width: 350px; max-width: 350px;">

                            <div class="d-flex justify-content-start">
                                <span class="fw-bold text-light">{{ review.full_name }}</span>
                            </div>
                            <div class="overflow-auto rounded" style="height: 100px;">
                                <span class="text-dark">{{ review.text }}</span>
                            </div>

                        </li>
                    </ul>
                </div>

                <div class="_line my_login_button my-5 rounded-pill w-100" style="height: 3px;"></div>

                <!-- reviews, ratings e message send -->
                <div id="ancor" class="d-flex flex-column gap-5 flex-lg-row gap-lg-0 justify-content-between mt-5">

                    <div class="d-flex flex-column align-items-center gap-5">
                        <h3 class="text-light">Review</h3>
                        <ReviewForm :developer="developer" />
                    </div>
                    <div class="d-flex flex-column align-items-center gap-5">
                        <h3 class="text-light">Rating</h3>
                        <RatingForm :developer="developer" />
                    </div>
                    <div class="d-flex flex-column align-items-center gap-5">
                        <h3 class="text-light">Message</h3>
                        <MessageForm :developer="developer" />
                    </div>

                </div>
            </div>



        </template>



    </AuthenticatedLayout>
</template>


<style lang="scss">
// @use 'resources/sass/variable.scss' as *;
@use '../../../resources/sass/devShow-layout-style.scss' as *;
@use 'resources/sass/form-style.scss';

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



/*PoP Up */
// .my_popuptext {
//     display: none;
//     max-width: 460px;
//     text-align: center;
//     border-radius: 6px;
//     padding: 8px 0;
//     margin-left: -80px;
//     position: absolute;
//     top: 50%;
//     left: 55%;
//     transform: translate(-50%, -50%);
// }

// /* Toggle this class when clicking on the popup container (hide and show the popup) */
// .popup .show {
//     display: block;
// }

// // To remove from display input file 
// input[type="file"] {
//     display: none;
// }
</style>