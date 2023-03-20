    




<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';



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
    // technologies
    technologies: props.developer.technologies,
    // sponsors
    sponsors: props.developer.sponsors,


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

function nameMonth(integer) {

    let month_word = null;

    if (integer === 1) {
        month_word = 'Jan';

    } else if (integer === 2) {
        month_word = 'Feb';

    } else if (integer === 3) {
        month_word = 'Mar';

    } else if (integer === 4) {
        month_word = 'Apr';

    } else if (integer === 5) {
        month_word = 'May';

    } else if (integer === 6) {
        month_word = 'Jun';

    } else if (integer === 7) {
        month_word = 'Jul';

    } else if (integer === 8) {
        month_word = 'Aug';

    } else if (integer === 9) {
        month_word = 'Sep';

    } else if (integer === 10) {
        month_word = 'Oct';

    } else if (integer === 11) {
        month_word = 'Nov';

    } else if (integer === 12) {
        month_word = 'Dec';

    } else {
        month_word = 'wrong month';
    };

    return month_word;
}

function daySuffix(integer) {


    let suffix = 'th';

    if (integer === 1 || integer === 21 || integer === 31) {
        suffix = 'st';

    } else if (integer === 2 || integer === 22) {
        suffix = 'nd';

    } else if (integer === 3 || integer === 23) {
        suffix = 'rd';

    };

    return suffix;

}

function now() {
    const now = new Date(Date.now());

    const time = {
        'year': now.getFullYear(),
        // .getMonth() restituisce da 0 a 11
        'month': (now.getMonth() + 1),
        // .getDate() restituisce day del mese
        'day': now.getDate(),
        'hour': now.getHours(),
        'min': now.getMinutes(),
        'sec': now.getSeconds(),



        // .getDay() restituisce day della settimana in numero
    };

    return time;


}

function formalDate(obj) {
    return nameMonth(obj.month) + ' ' + (obj.day).toString() + daySuffix(obj.day) + ' ' + (obj.year).toString();

}

function myGetTime(stringa) {

    const obj1 = stringToObj(stringa);
    const obj2 = now();



    let result = {
        'day': null,
        'hour': (obj1.hour).toString() + ':' + (obj1.min).toString(),
    }

    if (
        obj1.year === obj2.year &&
        obj1.month === obj2.month &&
        obj1.day === obj2.day
    ) {
        result.day = 'today';
    } else if (
        obj1.year === obj2.year &&
        obj1.month === obj2.month &&
        obj1.day === (obj2.day - 1)
    ) {
        result.day = 'yesterday';


    } else {

        result.day = formalDate(obj1);
    }


    return result;
}

function myRatingsAv() {
    let result = {
        'integer': Math.floor(props.developer.ratings_avg_value),
        'half': false,
    }


    let scarto = props.developer.ratings_avg_value - (result.integer);

    if (scarto > 0.25 && scarto <= 0.75) {
        result.half = true;

    } else if (scarto > 0.75) {

        (result.integer)++;
    };
    return (result);
}
const form = useForm({
    profile_path: null,
});
function sendImg() {
    form.post(route('profile.dev.store'));
}


function lastSponsor() {
    let dataFine = null;
    // ottengo la data più recende delle sponsors.date_end
    data.sponsors.forEach(element => {
        const dataSponsor = stringToObj(element.pivot.date_end);



        // se la data è successiva a oggi
        if (
            dataSponsor.year > now().year ||
            dataSponsor.year === now().year && dataSponsor.month > now().month ||
            dataSponsor.year === now().year && dataSponsor.month === now().month && dataSponsor.day > now().day



            // debug
            // dataSponsor.year > 1998 ||
            // dataSponsor.year === 1998 && dataSponsor.month > 3 ||
            // dataSponsor.year === 1998 && dataSponsor.month === 3 && dataSponsor.day > 20
        ) {

            // se dataFine è anchour vuoto lo riempo
            if (dataFine === null) {
                dataFine = dataSponsor;

                // altrimenti se la dataSponsor è maggiore della dataFine (già salvata)
            } else if (
                dataSponsor.year > dataFine.year ||
                dataSponsor.year === dataFine.year && dataSponsor.month > dataFine.month ||
                dataSponsor.year === dataFine.year && dataSponsor.month === dataFine.month && dataSponsor.day > dataFine.day
            ) {
                dataFine = dataSponsor;

            }


        }



    }
    )
    if (dataFine === null) {
        return false;
    } else {
        return (formalDate(dataFine));
    }
}
</script>





<script>
export default {
    data() {
        return {
            new_profile_path: undefined,
        }
    },
    methods: {
        updateImg() {
            axios.get('http://localhost:8000/api/v1/profile_path' + usePage().props.auth.user.id)
                .then((res) => { this.new_profile_path = 'sthourge/' + res.data.response.path })
                .catch((error) => console.log(error))
        }
    }
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

            <div class="my-background b-dark">

                <div class="container p-0">

                    <main class="d-flex justify-content-center position-relative">
                        <div class="left  overflow-scroll" v-if="(data.reviews).length || (data.messages).length">




                            <!-- reviews -->
                            <div class="my-border" v-if="(data.reviews).length">
                                <div class="title">
                                    My reviews
                                </div>
                                <ul class="principale">

                                    <li v-for="review in data.reviews">
                                        <div class=" mb-5 margin message">
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
                                                {{ myGetTime(review.created_at).day }}
                                                {{ myGetTime(review.created_at).hour }}

                                            </div>
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
                                    <li v-for="message in data.messages">
                                        <div class=" mb-5 margin message">


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
                                                {{ myGetTime(message.created_at).day }}
                                                {{ myGetTime(message.created_at).hour }}

                                            </div>
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

                                <div class="my-img-container mx-auto my-3">

                                    <img
                                        :src="(this.new_profile_path == undefined ? data.profile_path : this.new_profile_path)">
                                    <form class="d-flex justify-content-center align-items-center" method="post"
                                        enctype="multipart/form-data">
                                        <label for="profile_path" class="my-layover"> <i class="fa-solid fa-pencil"></i>
                                        </label>

                                        <input id="profile_path" type="file" name="profile_path"
                                            @input="form.profile_path = $event.target.files[0]; sendImg(); updateImg();">

                                    </form>

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

                                <div class="my-technologies">
                                    <div v-for="technology in data.technologies" class="my-technology">
                                        <img :src="technology.logo_path" alt="">
                                        <div class="titolo">
                                            {{ technology.name }}
                                        </div>

                                    </div>
                                </div>

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
                                    {{ Math.round(developer.ratings_avg_value * 100) / 100 }}
                                </div>
                                <div class="d-flex">
                                    <div v-for="any in (myRatingsAv(data.ratings)).integer">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div v-if="(myRatingsAv(data.ratings)).half">
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                    <div
                                        v-for="index in (5 - ((myRatingsAv(data.ratings))).integer - (((myRatingsAv(data.ratings)).half) ? 1 : 0))">
                                        <i class="fa-regular fa-star"></i>
                                    </div>

                                </div>

                            </div>
                            <!-- sponsors -->
                            <!-- only if there are more than 0 sponsors  -->
                            <div class="my-border sponsor">
                                <template v-if="lastSponsor()">
                                    <div>You are sponsored!</div>
    
                                    <div>Sponsor expires: {{ lastSponsor() }}</div>
                                </template>

                                <div v-else>You aren't sponsored!</div>

                                <a :href="route('braintree')" class="my-border">Get sponsored!</a>


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



$grigio-my-background: #424242;
$color-scritte: white;
$color-titles: yellow;
$color-shadow: yellow;




$h-my-background: calc(100vh - 100px);
$w-my-background: calc(100vw);


$h-main: calc($h-my-background - 70px);


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

    li {

        .message {
            list-style: none;
            padding: 15px 25px;
            border-radius: 0 13px 13px 13px;
            margin-top: 30px;
            max-width: 70%;
            background-color: #757575;
            // margin: 10px;
            transition: all 0.7s linear 0s;



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

        &:hover {
            .message {
                background-color: white;
                box-shadow: 20px white;
            }
        }
    }
}







.my-border {
    border: 1px solid white;
    border-radius: 0 0 10px 0;
    padding: 10px;
    display: flex;
    flex-direction: column;

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
        // background-color: $grigio-my-background;
        padding: 0 8px;
        font-size: 12px;
        color: white;
        position: absolute;

    }



}




body {


    .my-background {
        // background-color: $grigio-my-background;




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
                        margin-top: 50px;
                        border-radius: 0 0 20px 0;




                        .my-edit {

                            // no anchor dechourrion
                            text-dechourtion: inherit;
                            color: inherit;



                            background-color: rgba(255, 255, 255, 0.17);
                            color: white;
                            height: 40px;
                            width: 90%;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            // position: absolute;

                            // z-index necessary to stop propagation click
                            z-index: 100;


                            // transition doesn't seems to work.
                            transition: all 1s linear 1s;





                        }

                        .my-img-container {

                            width: 300px;
                            height: 300px;
                            position: relative;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            border-radius: 30%;
                            overflow: hidden;


                            img {
                                position: absolute;
                                width: 330px;
                                height: 330px;
                                object-fit: cover;

                            }

                            .my-layover {
                                cursor: pointer;
                                background-color: rgba(48, 48, 48, 0.675);
                                width: 300px;
                                height: 300px;
                                justify-content: center;
                                align-items: center;
                                position: absolute;
                                display: none;
                                font-size: 40px;



                            }



                            &:hover {

                                .my-layover {
                                    display: flex;


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
                            transition: all 0.1s linear 0s;


                            &.name {
                                border-radius: 0 0 10px 10px;
                                padding: 30px 10px;
                                font-size: 25px;
                                font-weight: bold;


                            }

                            &:hover {
                                position: relative;
                                padding-left: 20px;
                            }





                        }

                        .my-border {
                            position: relative;
                            max-height: 300px;
                            margin: 10px 0 0;
                            padding-right: 20px;
                            border-radius: 0 0 10px 0;
                            margin-top: 30px;



                            &:hover {
                                .title {
                                    color: $color-shadow;
                                }

                            }



                        }

                        a.my-border {
                            width: 70%;
                            margin-bottom: 10px;
                            text-dechourtion: none;
                            border-radius: 0 0 20px 0;
                            font-weight: bold;
                            font-size: 20px;

                            &:hover {
                                background-color: white;
                                color: #212529;
                                box-shadow: none;
                            }
                        }

                        .my-technologies {
                            margin: 50px 0;
                            display: flex;
                            justify-content: center;
                            flex-wrap: wrap;

                            .my-technology {
                                width: 100px;
                                height: 100px;
                                margin: 5px;
                                border-radius: 5px;
                                position: relative;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;


                                img {
                                    width: 50px;
                                    height: 50px;
                                    object-fit: contain;
                                    padding: 5px;





                                }

                                .titolo {
                                    display: none;
                                    transition: all 0.1s linear 0s;


                                }


                                &:hover {
                                    background-color: rgba(255, 255, 255, 0.151);

                                    .titolo {
                                        display: block;


                                    }
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
        .my-background {
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