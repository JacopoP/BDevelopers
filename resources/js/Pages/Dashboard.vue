<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';




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
    // ratings
    ratings: props.developer.ratings,


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

function myRatingsAv(array) {
    let somma = null;
    array.forEach(rating => {
        // the elements of the data.ratings array are objects;
        // we are interested in it's value.
        somma += rating.value
    });

    console.log(somma);
    let media = somma / array.length;


    let scarto = media - Math.floor(media);

    if (scarto <= 0.25) {
        scarto = 0;

    } else if (scarto > 0.25 && scarto <= 0.75) {
        scarto = 0.5;

    } else {
        scarto = 1;

    };


    return (Math.floor(media) + scarto);
}


const form = useForm({
    text: null,
    full_name: null,
    profile_path: null,
});


// PoP UP
function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
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

            <div class="sfondo b-dark">

                <div class="container p-0">

                    <main class="d-flex justify-content-center position-relative">
                        <div class="left  overflow-scroll" v-if="(data.reviews).length || (data.messages).length">




                            <!-- reviews -->
                            <div class="my-border" v-if="(data.reviews).length">
                                <div class="title">
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
                            <div class="my-border" v-if="(data.messages).length">
                                <div class="title">
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
                        <div class="right">

                            <div class="my-border my-shadow">

                                <div class="d-flex justify-content-center">
                                    <a href="/developer" class="my-edit">
                                        Developer Settings
                                    </a>
                                </div>

                                <div class="my-img-container" @click="myFunction()">

                                    <img :src="data.profile_path">

                                    <!-- PoP Up -->
                                    <div class="popup">

                                        <div class="my_popuptext my_login_button text-dark p-4 shadow" id="myPopup">
                                            <form class="d-flex justify-content-between" method="post"
                                                enctype="multipart/form-data"
                                                @submit.prevent="form.post(route('profile.dev.store'))">

                                                <div>
                                                    <!-- Profile IMG -->
                                                    <div class="mx-auto">
                                                        <label for="profile_path"
                                                            class="my_login_button_2 px-3 py-1 rounded-pill text-light btn btn-secondary border-0">Upload
                                                            Image</label>
                                                    </div>
                                                    <input id="profile_path" class="form-control border-dark rounded-pill"
                                                        type="file" name="profile_path"
                                                        @input="form.profile_path = $event.target.files[0]">
                                                </div>

                                                <!-- Submit -->
                                                <div class="d-flex justify-content-center">

                                                    <input
                                                        class="my_login_button_2 btn btn-secondary rounded-pill text-light border-0"
                                                        type="submit" value="SEND">
                                                </div>
                                            </form>

                                        </div>



                                    </div>
                                </div>









                                <div class="info name">
                                    {{ data.name }}
                                    {{ data.last }}
                                    <div class="title">
                                        Full Name
                                    </div>
                                </div>
                                <div class="info" v-if="data.email">
                                    {{ data.email }}
                                    <div class="title">
                                        E-mail
                                    </div>
                                </div>
                                <div class="info" v-if="data.address">
                                    {{ data.address }}
                                    <div class="title">
                                        Address
                                    </div>
                                </div>
                                <div class="info" v-if="data.phone_number">
                                    {{ data.phone_number }}
                                    <div class="title">Phone Number</div>
                                </div>
                                <div class="my-border" v-if="data.about_me">
                                    <div class="title">
                                        About me
                                    </div>
                                    <div class="principale">
                                        {{ data.about_me }}
                                    </div>
                                </div>
                                <div class="my-border" v-if="data.performances">

                                    <div class="title">
                                        My performances
                                    </div>
                                    <div class="principale">
                                        {{ data.performances }}
                                    </div>
                                </div>
                                <!-- cv_path -->
                                <a :href="data.portfolio_url"></a>

                            </div>
                            <!-- ratings -->
                            <!-- only if there are more than 0 ratings  -->
                            <div class="my-border" v-if="data.ratings.length">
                                <div>You've got
                                    <b>
                                        {{ data.ratings.length }}
                                    </b>
                                    ratings!
                                </div>
                                <div>
                                    Average:
                                </div>
                                <div class="d-flex align-text-bottom">
                                    <h2>{{ myRatingsAv(data.ratings) }}</h2>/5
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
$color-shadow: yellow;




$h-sfondo: calc(100vh - 100px);
$w-sfondo: calc(100vw);


$h-main: calc($h-sfondo - 70px);


// $h-principale: calc($h-main - 150px);
// DEBUG
.DEBUG {
    background-color: red;
}




.principale {
    padding-right: 20px;

    overflow: scroll;

    // no scrollbar Chrome, Safari and Opera
    &::-webkit-scrollbar {
        display: none;
    }

    /* IE and Edge */
    -ms-overflow-style: none;
    /* Firefox */
    scrollbar-width: none;


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







.my-border {
    border: 1px solid white;
    border-radius: 0 0 10px 0;
    padding: 10px;
    display: flex;
    flex-direction: column;
    box-shadow: 20px black;
    position: relative;
    overflow: scroll;

    // no scrollbar Chrome, Safari and Opera
    &::-webkit-scrollbar {
        display: none;
    }

    /* IE and Edge */
    -ms-overflow-style: none;
    /* Firefox */
    scrollbar-width: none;


    &:hover {
        box-shadow: 2px 2px 2px 2px $color-shadow;
    }

    .title {
        // background-color: $grigio-sfondo;
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
        // background-color: $grigio-sfondo;




        .container {
            width: 100vw;


            main {



                .left {
                    margin: 10px;
                    width: 100%;
                    padding: 0 10px;



                    .my-border {
                        position: relative;
                        margin: 50px 0 100px;
                        max-height: $h-main;

                        // overflow per il title
                        overflow: visible;

                        .title {

                            background-color: #212529;
                            position: absolute;
                            top: -40px;
                            left: -8px;
                            font-size: 30px;
                            color: $color-titles;
                        }


                    }

                }


                .right {

                    width: 40%;
                    display: flex;
                    flex-direction: column;
                    margin: 10px;



                    .title {

                        font-weight: bold;

                        top: -20px;
                        right: 0px;
                    }


                    .my-border {
                        overflow: visible;
                        color: white;
                        margin: 50px 0 100px;
                        border-radius: 0 0 20px 0;

                        &:hover {
                            .my-edit {
                                display: flex;
                            }
                        }

                        .my-edit {

                            // no anchor decorarion
                            text-decoration: inherit;
                            color: inherit;



                            background-color: rgba(255, 255, 255, 0.17);
                            color: white;
                            height: 40px;
                            width: 90%;
                            display: none;
                            justify-content: center;
                            align-items: center;
                            position: absolute;

                            // z-index necessary to stop propagation click
                            z-index: 100;


                            // transition doesn't seems to work.
                            transition: all 1s linear 1s;





                        }

                        .my-img-container {
                            $w-img: 300px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            position: relative;
                            width: 100%;
                            height: calc($w-img + 150px);

                            img {
                                width: $w-img;
                                height: $w-img;
                                object-fit: cover;
                                border-radius: 30%;
                                transition: all 0.7s linear 0s;


                                &:hover {

                                    $w-img: 320px;
                                    width: $w-img;
                                    height: $w-img;

                                }
                            }






                            /*PoP Up */
                            .my_popuptext {
                                display: none;
                                min-width: 160px;
                                max-width: 460px;
                                text-align: center;
                                border-radius: 6px;
                                padding: 8px 0;

                                position: absolute;
                                bottom: 0px;
                                left: 0px;

                            }

                            /* Toggle this class when clicking on the popup container (hide and show the popup) */
                            .popup .show {
                                display: block;
                            }

                            // To remove from display input file 
                            input[type="file"] {
                                display: none;
                            }


                        }


                        .info {
                            margin-top: 30px;
                            border-radius: 20px;
                            padding: 10px;
                            color: white;
                            position: relative;
                            transition: all 0.4s linear 0s;


                            &.name {
                                border-radius: 0 0 10px 10px;
                                padding: 30px 10px;



                            }

                            &:hover {
                                position: relative;
                                padding-left: 20px;
                            }





                        }

                        .my-border {
                            position: relative;
                            max-height: 300px;
                            margin: 50px 0 0;
                            padding-right: 20px;
                            border-radius: 0 0 10px 0;


                            &:hover {
                                .title {
                                    color: $color-shadow;
                                }

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



                    .left {



                        .my-border {

                            .title {}


                        }

                    }


                    .right {


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