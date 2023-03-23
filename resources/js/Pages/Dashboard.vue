    




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
import StarRating from 'vue-star-rating';
export default {
    components: {
        StarRating,
    },
    data() {
        return {
            new_profile_path: undefined,
            reloadNavbar: true,
        }
    },
    methods: {
        updateImg() {
            this.reloadNavbar = false;
            axios.get('http://localhost:8000/api/v1/profile_path' + usePage().props.auth.user.id)
                .then((res) => { this.new_profile_path = 'storage/' + res.data.response.path; this.reloadNavbar = true })
                .catch((error) => console.log(error))
        }
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :reloadNavbar="this.reloadNavbar">

        <template #header>
            <div class="d-flex justify-content-between">
                <h2>Dashboard</h2>
            </div>
        </template>

        <template #main>

            <div class="my-background b-dark container">

                <div class="container pb-5">

                    <main
                        class="d-flex flex-column-reverse flex-lg-row align-items-center align-items-lg-start justify-content-center position-relative">

                        <div class="left overflow-scroll" v-if="(data.reviews).length || (data.messages).length">




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

                            <div class="my-border my-shadow p-5">

                                <div class="d-flex flex-column align-items-center">

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

                                    <div class="d-flex justify-content-center" style="width: 200px;">
                                        <a href="/developer"
                                            class="btn my_register_button btn-secondary border-0 rounded-pill">
                                            Developer Settings

                                        </a>
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
                                    <span class="text-truncate">{{ data.email }}</span>
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

                                <!-- CV -->
                                <a v-if="data.cv_path !== null"
                                    class="btn btn-outline-secondary rounded-pill d-flex align-items-center m-5"
                                    style="width:fit-content" :href="'storage/' + data.cv_path" download>Download CV
                                </a>



                                <a :href="data.portfolio_url"></a>

                                <div class="my-technologies mx-auto">
                                    <div v-for="technology in data.technologies" class="my-technology">
                                        <img :src="technology.logo_path" alt="">
                                        <div class="titolo">
                                            {{ technology.name }}
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="rat-spon-cont">
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
                                    <star-rating class="text-light" v-model:rating="developer.ratings_avg_value"
                                        :active-color="['#410000', '#410000', '#f7a531']" :border-width="0"
                                        :star-points="[23, 2, 14, 17, 0, 19, 10, 34, 7, 50, 23, 43, 38, 50, 36, 34, 46, 19, 31, 17]"
                                        :active-on-click="true" :clearable="false" :show-rating="false" :star-size="25"
                                        :increment="0.01" :read-only="true"></star-rating>

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
                        </div>
                    </main>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>




<style lang="scss" scoped>
@use 'resources/sass/general.scss' as *;
@use 'resources/sass/variable.scss';
@use 'resources/sass/form-style.scss';

input[type=file] {
    display: none;
}

$grigio-my-background: #424242;
$color-scritte: white;
$color-titles: $brand_fourth;
$color-shadow: $brand_fourth;





$h-main: calc(100vh - 170px);



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
            // max-width: 70%;
            background-color: #fff;



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
                box-shadow: 5px 10px 5px $brand_third;
            }
        }
    }
}







.my-border {
    background-color: $brand_primary;
    // border: 1px solid white;
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








        main {



            .left {
                margin: 10px;
                width: 100%;
                padding: 0 10px;



                .my-border {
                    position: relative;
                    margin: 50px 0 100px;
                    max-height: calc(100vh - 140px);
                    // max-height: $h-main;

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

                // width: 40%;
                display: flex;
                flex-direction: column;
                margin: 10px;



                .title {

                    font-weight: bold;

                    top: -20px;
                    right: 0px;
                }


                .my-border {
                    // overflow: visible;
                    color: white;
                    margin-top: 50px;
                    border-radius: 0 0 20px 0;






                    .my-img-container {

                        width: 300px;
                        height: 300px;
                        position: relative;
                        display: flex;
                        justify-content: center;
                        align-items: center;


                        img {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            border-radius: 80px;
                        }

                        .my-layover {
                            cursor: pointer;
                            background-color: rgba(48, 48, 48, 0.675);
                            width: 100%;
                            height: 100%;
                            justify-content: center;
                            align-items: center;
                            position: absolute;
                            display: none;
                            font-size: 40px;
                            border-radius: 80px;
                        }



                        &:hover {

                            .my-layover {
                                display: flex;


                            }

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
                        overflow: visible;
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
                        text-decoration: none;
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
                        max-width: 90%;
                        margin: 50px 0;
                        display: flex;
                        justify-content: start;
                        flex-wrap: wrap;
                        // gap: 10px;

                        .my-technology {
                            width: 70px;
                            height: 70px;
                            margin: 5px;
                            padding: 10px;
                            border-radius: 5px;
                            position: relative;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;


                            // img {
                            //     width: 50px;
                            //     height: 50px;
                            //     object-fit: contain;
                            //     padding: 5px;





                            // }

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
</style>