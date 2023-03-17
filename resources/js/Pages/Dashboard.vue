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
    email: props.developer.user.email,
    // developer
    address: props.developer.address,
    phone_number: props.developer.phone_number,
    profile_path: props.developer.profile_path
        // ? props.developer.profile_path
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




function myGetTime(stringa) {

    const obj1 = stringToObj(stringa);
    const obj2 = now();


    let result = {
        'giorno': null,
        'ora': (obj1.hour).toString() + ':' + (obj1.min).toString(),
    }

    if (
        obj1.year === obj2.year &&
        obj1.month === obj2.month &&
        obj1.day === obj2.day
    ) {
        result.giorno = 'today';
    } else if (
        obj1.year === obj2.year &&
        obj1.month === obj2.month &&
        obj1.day === (obj2.day - 1)
    ) {
        result.giorno = 'yesterday';


    } else {
        result.giorno = (obj1.day).toString() + '-' + (obj1.month).toString() + '-' + (obj1.year).toString();


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
                <!-- <header class="d-flex justify-between ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <h1>Your profile</h1>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </header> -->
                <div class="container p-0">

                    <main class="d-flex justify-content-center">
                        <!-- <main class="d-flex justify-between"> -->
                        <div class="sinistra  overflow-scroll" v-if="(data.reviews).length || (data.messages).length">

                            <!-- reviews -->
                            <div class="my-cornice" v-if="(data.reviews).length">
                                <div class="titolo">
                                    My reviews
                                </div>
                                <ul class="principale">

                                    <li v-for="review in data.reviews" class="shadow-lg mb-5 bg-white margin secondario">
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
                                            {{ myGetTime(review.created_at).giorno }}
                                            {{ myGetTime(review.created_at).ora }}

                                        </div>


                                    </li>
                                </ul>
                            </div>
                            <!-- messages -->
                            <div class="my-cornice" v-if="(data.messages).length">
                                <div class="titolo">
                                    My messages
                                </div>
                                <ul class="principale">

                                    <li v-for="message in data.messages" class="shadow-lg mb-5 bg-white margin secondario">
                                        <div v-if="message.full_name != undefined" class="reviewer">
                                            {{ message.full_name }}

                                        </div>
                                        <div v-else class="anonymous">
                                            anonymous
                                        </div>
                                        <a href="mailto:{{ message.email }}" class="email">{{ message.email }}</a>
                                        <!-- <div class="email">
                                                {{ message.email }}

                                            </div> -->
                                        <p>
                                            {{ message.text }}
                                        </p>
                                        <div class="created-at">
                                            {{ myGetTime(message.created_at).giorno }}
                                            {{ myGetTime(message.created_at).ora }}

                                        </div>


                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- image and data user developer -->
                        <div class="destra">

                            <div class="my-cornice">
                                <div class="my-img-container ">
                                    <!-- :class="data.profile_path === default_profile_path ? 'no-pic' : null" -->

                                    <img :src="data.profile_path">


                                </div>


                                <div class="">
                                    <div class="dato">
                                        {{ data.name }}
                                        {{ data.last }}
                                        <div class="titolo">
                                            Full Name
                                        </div>
                                    </div>
                                    <div class="dato" v-if="data.email">
                                        {{ data.email }}
                                        <div class="titolo">
                                            E-mail
                                        </div>
                                    </div>
                                    <div class="dato" v-if="data.address">
                                        {{ data.address }}
                                        <div class="titolo">
                                            Address
                                        </div>
                                    </div>
                                    <div class="dato" v-if="data.phone_number">
                                        {{ data.phone_number }}
                                        <div class="titolo">Phone Number</div>
                                    </div>
                                    <div class="my-cornice" v-if="data.about_me">
                                        <div class="titolo">
                                            About me
                                        </div>
                                        <div class="principale">
                                            {{ data.about_me }}
                                        </div>
                                    </div>
                                    <div class="my-cornice" v-if="data.performances">

                                        <div class="titolo">
                                            My performances
                                        </div>
                                        <div class="principale">
                                            {{ data.performances }}
                                        </div>
                                    </div>
                                    <!-- cv_path -->
                                    <a :href="data.portfolio_url"></a>
                                </div>
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
$color-scritte: white;
$color-titles: yellow;
$h-header: 50px;


$h-sfondo: calc(100vh - 100px);
$w-sfondo: calc(100vw);


$h-main: calc($h-sfondo - 70px);


// $h-principale: calc($h-main - 150px);






.principale {
    overflow: scroll;

    &::-webkit-scrollbar {
        display: none;
    }

    .secondario {
        list-style: none;
        padding: 15px 25px;
        border-radius: 0 13px 13px 13px;
        margin-top: 30px;
        // margin: 10px;

        .reviewer {
            font-weight: bold;
            color: $brand_fourth;
        }

        .email {
            color: rgb(2, 91, 91);
        }

        .anonymous {
            font-style: italic;
            font-size: 12px;
            color: rgb(67, 67, 67);
        }

        p {
            margin-top: 5px;
        }

        .created-at {
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
    position: relative;

    &:first-child {
        border-radius: 0 0 0 10px;
        border-bottom: 2px solid white;

    }

    .titolo {
        right: -8px;
        bottom: 0;
    }
}

.my-cornice {
    border: 1px solid white;
    border-radius: 0 0 10px 0;
    padding: 10px;
    display: flex;
    flex-direction: column;
    box-shadow: 20px black;
    position: relative;
    margin: 50px 0 100px;
    overflow: scroll;

    .titolo {
        background-color: $grigio-sfondo;
        padding: 0 8px;
        font-size: 12px;
        color: white;
        position: absolute;

    }

    .testo {

        li {
            margin-bottom: 20px;
            padding: 0 20px;
        }

    }

}




body {


    .sfondo {
        background-color: $grigio-sfondo;



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
                    margin: 10px;
                    width: 100%;
                    padding: 0 10px;

                    // no scrollbar Chrome, Safari and Opera
                    &::-webkit-scrollbar {
                        display: none;
                    }

                    /* IE and Edge */
                    -ms-overflow-style: none;
                    /* Firefox */
                    scrollbar-width: none;
                    // con firefox non sembra funzionare


                    .my-cornice {
                        position: relative;
                        max-height: $h-main;

                        // overflow per il titolo
                        overflow: visible;

                        .titolo {
                            position: absolute;
                            top: -40px;
                            left: -8px;
                            font-size: 30px;
                            color: $color-titles;
                        }


                    }

                }


                .destra {

                    width: 40%;
                    display: flex;
                    flex-direction: column;
                    margin: 10px;





                    .my-cornice {
                        overflow: visible;
                        color: white;
                        border-radius: 0 0 20px 0;

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

                        .my-cornice {
                            max-height: 300px;
                            margin: 50px 0 0;
                            padding-right: 20px;
                            border-radius: 0 0 10px 0;

                            .titolo {

                                font-weight: bold;

                                top: -20px;
                                right: 0px;
                            }
                        }



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



                        .my-cornice {

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