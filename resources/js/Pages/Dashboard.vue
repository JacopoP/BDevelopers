<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';



const props = defineProps([
    'developer'
]);

const default_profile_path = 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png';

const data = {
    // user
    name: props.developer.user.name,
    last: props.developer.user.last,
    // developer
    address: props.developer.address,
    phone_number: props.developer.phone_number,
    profile_path: props.developer.profile_path
        ? 'storage/' + props.developer.profile_path
        : default_profile_path,
    cv_path: props.developer.cv_path,
    portfolio_url: props.developer.portfolio_url,
    about_me: props.developer.about_me,
    performances: props.developer.performances,
    // reviews
    reviews: props.developer.reviews,
    // messages
    messages: props.developer.messages,

};


function stringToObj(stringa) {
    const time = {
        'year': parseInt(stringa.substring(0, 4)),
        'month': parseInt(stringa.substring(5, 7)),
        'day': parseInt(stringa.substring(8, 10)),
        'hour': parseInt(stringa.substring(11, 13)),
        'min': parseInt(stringa.substring(14, 16)),
        'sec': parseInt(stringa.substring(17, 19)),
    };


    return time;
}

function now() {
    const now = new Date(Date.now());

    const time = {
        'year': now.getFullYear(),
        // .getMonth() restituisce da 0 a 11
        'month': (now.getMonth() + 1),
        // .getDate() restituisce giorno del mese
        'day': now.getDate(),
        'hour': now.getHours(),
        'min': now.getMinutes(),
        'sec': now.getSeconds(),



        // .getDay() restituisce giorno della settimana in numero
    };

    return time;


}




function compareDays(stringa) {

    const obj1 = stringToObj(stringa);
    const obj2 = now();

    let result = false;

    if (
        obj1.year === obj2.year &&
        obj1.month === obj2.month &&
        obj1.day === obj2.day
    ) {
        result = true;
    }

    return result;
}




</script>

<template>
    <AuthenticatedLayout>

        <template #header>
            <div class="d-flex justify-content-between">
                <h2>Dashboard</h2>
            </div>
        </template>

        <template #main>

            <div class="sfondo">
                <header class="d-flex justify-between DEBUG">
                    <h1>Your profile</h1>
                </header>
                <div class="container p-0">

                    <main class="d-flex justify-between DEBUG">
                        <div class="sinistra  overflow-scroll DEBUG">

                            <!-- reviews -->
                            <div class="spazio DEBUG ">
                                <div class="titolo">
                                    My reviews
                                </div>
                                <ul class="reviews">
                                    <!-- <div class="shadow-lg p-3 mb-5 bg-white rounded margin"> -->
                                    <li v-for="review in data.reviews" class="shadow-lg mb-5 bg-white margin review">
                                        <!-- <li v-for="review in data.reviews" class="review"> -->
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
                                            {{ compareDays(review.created_at) }}

                                        </div>
                                        <!-- <div class="created-at">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                {{ review.created_at.substring(0, 10) }}

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->



                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- image and data user developer -->
                        <div class="destra DEBUG">
                            <div class="my-img-container DEBUG">
                                <!-- :class="data.profile_path === default_profile_path ? 'no-pic' : null" -->

                                <img :src="data.profile_path">


                            </div>


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
$color-titles: yellow;
$h-header: 50px;

// $h-sfondo: 500px;
$h-sfondo: calc(100vh - $h-primary_navigation_menu - $h-subnavbar);
$w-sfondo: calc(100vw);

// $h-main: 300px;
$h-main: calc($h-sfondo - 50px);


$h-review: calc($h-main - 50px);





// .DEBUG {
//     border: 1px solid green;
//     background-color: rgba(255, 255, 255, 0.244);
// }

.reviews {
    height: $h-review;
    overflow: scroll;
    padding-right: 20px;

    &::-webkit-scrollbar {
        display: none;
    }

    .review {
        // background-color: white;
        list-style: none;
        padding: 15px 25px;
        border-radius: 0 13px 13px 13px;
        // margin: 10px;

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
    color: white;

    &:first-child {
        border-radius: 0 0 0 10px;
        border-bottom: 2px solid white;

    }
}

.spazio {
    border: 1px solid white;
    border-radius: 0 0 10px 0;
    padding: 10px;
    display: flex;
    box-shadow: 20px black;
    position: relative;

    .titolo {
        background-color: $grigio-sfondo;
        padding: 0 8px;
        top: -13px;
        left: -8px;
        font-size: 12px;
        color: white;
        position: absolute;

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
        height: $h-sfondo;
        width: $w-sfondo;
        background-color: $grigio-sfondo;
        position: fixed;



        header {
            height: $h-header;
            // background-color: aqua;

            h1 {
                font-size: 2.5rem;
                font-weight: bold;
            }
        }

        .container {
            width: 100vw;


            main {



                .sinistra {
                    height: $h-main;
                    overflow: scroll;
                    margin: 10px;
                    width: 100%;

                    // no scrollbar Chrome, Safari and Opera
                    &::-webkit-scrollbar {
                        display: none;
                    }

                    /* IE and Edge */
                    -ms-overflow-style: none;
                    /* Firefox */
                    scrollbar-width: none;
                    // con firefox non sembra funzionare


                    .spazio {
                        margin: 50px 0;
                        position: relative;

                        .titolo {
                            position: absolute;
                            top: -35px;
                            font-size: 30px;
                            color: $color-titles;
                        }


                    }

                }


                .destra {
                    padding: 0 10px;
                    width: 40%;
                    display: flex;
                    flex-direction: column;
                    height: $h-main;
                    overflow: scroll;
                    overflow-x: hidden;
                    margin: 10px;

                    // no scrollbar Chrome, Safari and Opera
                    &::-webkit-scrollbar {
                        display: none;
                    }

                    /* IE and Edge */
                    -ms-overflow-style: none;
                    /* Firefox */
                    scrollbar-width: none;
                    // con firefox non sembra funzionare


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

                            .titolo {}


                        }

                    }


                    .destra {


                        .my-img-container {
                            $w-img: 100px;
                            height: $w-img;

                            img {
                                width: $w-img;
                                height: $w-img;
                            }
                        }


                    }
                }
            }
        }
    }


}
</style>