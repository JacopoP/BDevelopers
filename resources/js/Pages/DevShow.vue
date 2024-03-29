<script>
import ReviewForm from '@/Pages/ShowComponents/ReviewForm.vue';
import MessageForm from '@/Pages/ShowComponents/MessageForm.vue';
import RatingForm from '@/Pages/ShowComponents/RatingForm.vue';
import StarRating from 'vue-star-rating';
import { Head } from '@inertiajs/vue3';

// AuthenticatedLayout
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const link = 'http://localhost:8000/api/v1/';

export default {
    props:['developer'],
    components:{
        StarRating,
        ReviewForm,
        MessageForm,
        RatingForm,
        AuthenticatedLayout,
        Head,
    },
    data() {
        return {
            dati: {
                name: this.developer.user.name,
                last: this.developer.user.last,
                address: this.developer.address,
                phone_number: this.developer.phone_number,
                profile_path: this.developer.profile_path
                    ? this.developer.profile_path
                    : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png",
                cv_path: this.developer.cv_path,
                portfolio_url: this.developer.portfolio_url,
                about_me: this.developer.about_me,
                performances: this.developer.performances,
                reviews: this.developer.reviews,
            },

            voidMessage: 'This field has not been filled yet',
        }
    },
    methods: {
        copyText(id) {
            const testoDaCopiare = document.querySelector(`#${id}`)
            navigator.clipboard.writeText(testoDaCopiare.innerText)
        },
        updateReviews() {
            axios.get(link + 'reviews' + this.developer.id)
            .then((res) => {this.dati.reviews = res.data.response.reviews})
            .catch((error) => console.log(error))
        },

    }
}
</script>

<template>
    <Head :title="dati.name + ' ' + dati.last" />

    <AuthenticatedLayout>

        <template #main>

            <!-- contacts -->
            <div class="container mt-5 py-5">

                <div class="d-flex justify-content-around align-items-center flex-column flex-xl-row gap-5">

                    <div class="d-flex flex-lg-row align-items-lg-center gap-lg-3 flex-column align-items-center">
                        <div>
                            <img class="img_profile rounded-circle shadow " :src="'storage/' + this.dati.profile_path">
                        </div>
                        <!-- INFO -->
                        <div v-if="this.dati.name !== null || this.dati.last !== null || this.dati.address !== null || this.dati.phone_number !== null || this.dati.portfolio_url !==null || this.dati.cv_path !== null" class="d-flex flex-column align-items-center align-items-lg-start gap-5">

                            <div class="d-flex fs-3 gap-2 pt-2">
                                <span v-if="this.dati.name !== null" class="text-light fw-bold">
                                    {{ this.dati.name }}
                                </span> 
                                <span v-if="this.dati.last !== null" class="text-light fw-bold">
                                    {{ this.dati.last }}
                                </span>
                            </div>
                            
                            <!-- RatingAVG -->
                            <div>
                                <star-rating class="text-light" 
                                v-model:rating="developer.ratings_avg_value" 
                                :active-color="['#410000', '#410000', '#f7a531']" 
                                :border-width="0" 
                                :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]" 
                                :active-on-click="true" 
                                :clearable="false" 
                                :show-rating="false"
                                :star-size="25"
                                :increment="0.01"
                                :read-only="true"
                                ></star-rating>
                            </div>

                            <div class="d-flex flex-column align-items-start gap-3">
                                <div v-if="this.dati.address !== null"
                                    class="my_login_button d-flex align-items-center rounded px-3 py-2 gap-3"
                                    style="max-width: 350px;">
                                    <h5 class="text-light fs-6 w-50">Address:</h5>
                                    <p id="copyAddress" class="fs-6 text-secondary m-0 text-truncate">{{ this.dati.address
                                    }}
                                    </p>

                                    <!-- Copy -->
                                    <button class="my_login_button btn btn-secondary text-light border-0"
                                        @click="copyText('copyAddress')">
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </div>

                                <div v-if="this.dati.phone_number !== null"
                                    class="my_login_button d-flex align-items-center rounded px-3 py-2 gap-3"
                                    style="max-width: 350px;">
                                    <h5 class="text-light fs-6 w-50"> Phone number:</h5>
                                    <p id="copyPhoneNumber" class="fs-6 text-secondary m-0 text-truncate">
                                        {{ this.dati.phone_number }}</p>

                                    <!-- Copy -->
                                    <button class="my_login_button btn btn-secondary text-light border-0"
                                        @click="copyText('copyPhoneNumber')">
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center justify-content-lg-center gap-4 w-100">
                                <a class="btn btn-danger my_register_button border-0 rounded-pill text-light px-3 py-2" :href="this.dati.portfolio_url" v-if="this.dati.portfolio_url !== null">
                                    Show my portfolio
                                </a>

                                <!-- CV -->
                                <a v-if="this.dati.cv_path !== null"
                                    class="btn btn-outline-secondary rounded-pill d-flex align-items-center"
                                    :href="'storage/' + this.dati.cv_path" download>Download CV
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="#ancor" class="btn btn-primary rounded-pill my_login_button text-light">
                            Send a Message, Reviews or a Star
                        </a>
                    </div>
                </div>

                <!-- Curriculum etc... -->
                <div class="_line my_login_button_2 my-5 rounded-pill w-100 shadow" style="height: 3px;"></div>

                <div class="d-flex flex-column gap-4">
                    <!-- About -->
                    <div class="d-flex flex-column gap-3 flex-lg-row gap-lg-0 justify-content-between my_login_button p-3 rounded mt-4">
                        <div v-if="this.dati.about_me !== null" class="order-2 order-lg-2 text-light">
                            {{ this.dati.about_me }}
                        </div>
                        <!-- Empty Messsage -->
                        <div v-else class="order-2 order-lg-2 text-primary d-flex align-items-center justify-content-center border-primary border-2 border rounded px-3 py-2"> 
                            <h6>{{this.voidMessage}}</h6>   
                        </div>
                        <h3 class="order-1 order-lg-1 col-lg-3 text-light">About me</h3>
                    </div>

                    <!-- My Performance -->
                    <div class="d-flex flex-column gap-3 flex-lg-row gap-lg-0 justify-content-between my_login_button p-3 rounded mt-4">
                        <div v-if="this.dati.performances !== null" class="order-2 order-lg-1 text-light">
                            {{ this.dati.performances }}
                        </div>
                        <!-- Empty Messsage -->
                        <div v-else class="order-2 order-lg-1 text-primary d-flex align-items-center justify-content-center border-primary border-2 border rounded px-3 py-2">
                            <h6>{{this.voidMessage}}</h6> 
                        </div>
                        <h3 class="order-1 order-lg-2 col-lg-3 text-light text-start text-lg-end">My Performances</h3>
                    </div>

                </div>

                <div class="_line my_login_button_2 mt-5 mb-3 rounded-pill w-100 shadow" style="height: 3px;"></div>

                <!-- Reviews -->
                <div class="d-flex flex-column align-items-center gap-4">
                    <h3 class="text-light">My Reviews</h3>
                    <ul class="text-light d-inline-flex gap-4 overflow-auto" style="max-width: 100%; min-height: 100px;">
                        <li v-for="review in this.dati.reviews"
                            class="my_background_secondary text-start card rounded py-3 px-5 shadow"
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

                <div class="_line my_login_button_2 my-5 rounded-pill w-100 shadow" style="height: 3px;"></div>

                <!-- reviews, ratings e message send -->
                <div id="ancor" class="d-flex flex-column gap-5 flex-lg-row gap-lg-0 justify-content-between mt-5">

                    <div class="d-flex flex-column align-items-center gap-5">
                        <h3 class="text-light">Review</h3>
                        <ReviewForm :developer="developer" @updateReviews="updateReviews()" />
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
@use 'resources/sass/devShow-layout-style.scss' as *;
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
    max-height: 400px;
    object-fit: cover;
}
</style>