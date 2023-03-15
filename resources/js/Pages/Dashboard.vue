<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';



const props = defineProps([
    'developer'
]);

const default_profile_path = 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png';

const data = {
    name: props.developer.user.name,
    last: props.developer.user.last,
    address: props.developer.address,
    phone_number: props.developer.phone_number,
    profile_path: props.developer.profile_path
        ? 'storage/' + props.developer.profile_path
        : default_profile_path,
    cv_path: props.developer.cv_path,
    portfolio_url: props.developer.portfolio_url,
    about_me: props.developer.about_me,
    performances: props.developer.performances,
    reviews: props.developer.reviews,

};

let dateTimeUTC = new Date("2021-01-01T12:00:00Z");

console.log(dateTimeUTC);
console.log('2023-03-10T09:50:51.000000Z');
console.log(data.reviews[1].created_at);
// const millisecondi = (data.reviews[0].created_at).getTime();
// // const millisecondi = (new Date(data.reviews[0].created_at)).getTime();
// console.log(millisecondi);
// const millisecondiVeri = ((2023 - 1970) * (365.25 * 24 * 60 * 60 * 1000)) + (9 * (60 * 60 * 1000)) + (50 * (60 * 1000)) + (51 * (1000));
// console.log("millisecondiVeri " + millisecondiVeri);
// const errore = millisecondi - millisecondiVeri;
// console.log("errore " + errore);
// const erroreGiorni = errore / (24 * 60 * 60 * 1000);
// console.log("erroreGiorni " + erroreGiorni);

console.log("app's on");
</script>

<template>
    <AuthenticatedLayout>

        <template #header>
            <div class="d-flex justify-content-between">
            <h2>Dashboard</h2>
        </div>
    </template>

    <template #main>

            <header class="d-flex justify-between DEBUG">
                <h1>Your profile</h1>
            </header>
            <div class="sfondo">
                <div class="container p-0">

                    <main class="d-flex justify-between DEBUG">
                        <div class="sinistra  overflow-scroll DEBUG">

                            <div class="spazio DEBUG">
                                <div class="titolo">
                                    My reviews
                                </div>
                                <ul class="reviews">
                                    <li v-for="review in data.reviews" class="review">
                                        <div v-if="review.full_name != undefined" class="reviewer">
                                            {{ review.full_name }}

                                        </div>
                                        <div v-else class="anonymous">
                                            anonymous
                                        </div>
                                        <p>
                                            {{ review.text }}
                                        </p>
                                        <div class="created-at">
                                            {{ review.created_at }}

                                        </div>



                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- image and data user developer -->
                        <div class="destra DEBUG">
                            <!-- <div class="my-img-container DEBUG"
                                                                                                                                        :class="data.profile_path === default_profile_path ? 'no-pic' : null">

                                                                                                                                        <img :src="data.profile_path">


                                                                                                                                    </div> -->


                            <div class="DEBUG">
                                <div class="dato DEBUG">
                                    {{ data.name }}
                                    {{ data.last }}
                                </div>
                                <div class="dato DEBUG">
                                    {{ data.address }}
                                </div>
                                <div class="dato DEBUG">
                                    {{ data.phone_number }}
                                </div>
                                <div class="spazio DEBUG" v-if="data.about_me">
                                    <div class="titolo">
                                        About me
                                    </div>
                                    <div class="testo">
                                        {{ data.about_me }}
                                    </div>
                                </div>
                                <div class="spazio DEBUG" v-if="data.performances">
                                    <div class="titolo">
                                        My performances
                                    </div>
                                    <div class="testo">
                                        {{ data.performances }}
                                    </div>
                                </div>
                                <!-- cv_path -->
                                <a :href="data.portfolio_url"></a>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </template>

    </AuthenticatedLayout>
</template>




<style lang="scss" scoped>
@use 'resources/sass/general.scss' as *;

$grigio-sfondo: #424242;
// $grigio-sfondo: #212529;
$color-scritte: white;
$h-header: 100px;
$h-main: calc(98vh - $h-header);





// .DEBUG {
//     border: 1px solid green;
//     background-color: rgba(255, 255, 255, 0.244);
// }

.reviews {
    height: 70vh;
    overflow: scroll;

    .review {
        background-color: white;
        list-style: none;
        padding: 15px 25px 25px 25px;
        border-radius: 0 13px 13px 13px;
        margin: 10px;

        .reviewer {
            font-weight: bold;
            color: $brand_fourth;
        }

        .anonymous {
            font-style: italic;
            font-size: 12px;
            color: rgb(67, 67, 67);
        }

        .created-at {
            // margin-bottom: 10px;
            text-align: end;
            font-size: 12px;
        }

    }
}

.dato {
    margin: 25px 5px;
    padding: 5px 15px 0px;
    // max-width: 300px;
    border-bottom: 1px solid white;

    &:first-child {
        border-radius: 0 0 0 10px;
        border-bottom: 2px solid white;

    }
}

.spazio {
    border: 1px solid white;
    border-radius: 0 0 10px 0;
    padding: 10px;
    position: relative;
    box-shadow: 20px black;

    .titolo {
        background-color: $grigio-sfondo;
        padding: 0 8px;
        position: absolute;
        top: -13px;
        left: -8px;
        font-size: 12px;
        color: white;

    }

    .testo {
        max-height: 300px;
        overflow-y: scroll;

        li {
            margin-bottom: 20px;
            padding: 0 20px;
        }

    }

}




body {

    .sfondo {
        background-color: $grigio-sfondo;

        .container {
            width: 100vw;

            header {
                height: $h-header;

                h1 {
                    font-size: 2.5rem;
                    font-weight: bold;
                }
            }

            main {
                height: $h-main;



                .sinistra {
                    margin: 10px;
                    width: 100%;



                    .spazio {
                        margin: 50px 0;


                        .titolo {

                            top: -35px;
                            font-size: 30px;
                        }


                    }

                }


                .destra {
                    padding: 0 10px;
                    width: 40%;
                    display: flex;
                    flex-direction: column;
                    overflow-y: scroll;
                    overflow-x: hidden;
                    margin: 10px;


                    .my-img-container {
                        $w-img: 300px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 100%;
                        height: calc($w-img + 150px);

                        img {
                            width: $w-img;
                            height: $w-img;
                            object-fit: cover;
                            border-radius: 30%;
                        }
                    }


                    .spazio {

                        margin: 70px 0;

                    }
                }
            }
        }
    }
}





@media screen and (max-width: 1200px) {


    body {
        .sfondo {
            .container {
                header {

                    h1 {}
                }

                main {



                    .sinistra {



                        .spazio {

                            titolo {}


                        }

                    }


                    .destra {


                        .my-img-container {
                            $w-img: 100px;

                            img {
                                width: $w-img;
                                height: $w-img;
                            }
                        }


                        .spazio {}
                    }
                }
            }
        }
    }


}
</style>