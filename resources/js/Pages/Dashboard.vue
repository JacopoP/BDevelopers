<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';



const props = defineProps([
    'developer',
]);


console.log(props);

const data = {
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

</script>

<template>
    <header class="d-flex justify-between DEBUG">
        <h1>Your profile</h1>
        <div>
            <div>
                <a href="/profile">Profile</a>
            </div>
            <div>
                <a href="/index">index</a>
            </div>
        </div>
    </header>
    <div class="container">

        <main class="d-flex justify-between DEBUG">
            <div class="sinistra  overflow-scroll DEBUG">
                <div class="DEBUG">
                    <div class="dato DEBUG">
                        {{ data.name }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.last }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.address }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <div class="dato DEBUG">
                        {{ data.phone_number }}
                    </div>
                    <!-- cv_path -->
                    <a :href="data.portfolio_url"></a>
                </div>

            </div>
            <div class="destra DEBUG">
                <div class="my-img-container DEBUG">

                    <img :src="data.profile_path">
                </div>
            </div>
        </main>
    </div>
</template>


<style lang="scss">
$grigio-sfondo: #212529;
$scritte: rgb(255, 255, 255);
$h-header: 100px;
$h-main: calc(98vh - $h-header);



// debug
$DEBUG: rgba(255, 255, 255, 0.244);

.DEBUG {
    border: 1px solid green;
    background-color: $DEBUG;
}

body {
    background-color: $grigio-sfondo;
    color: $scritte;
    position: relative;

    header {
        height: $h-header;

        h1 {
            color: white;
        }
    }

    main {
        position: static;
        height: $h-main;



        .sinistra {
            margin: 10px;
            width: 100%;
        }


        .destra {
            padding: 0 10px;
            width: 40%;
            display: flex;
            justify-content: center;
            margin: 10px;


            .my-img-container {
                $w-img: 200px;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden;
                width: calc($w-img + 150px);
                height: calc($w-img + 150px);

                img {
                    width: $w-img;
                    height: $w-img;
                    object-fit: cover;
                    border-radius: 30%;
                }
            }
        }
    }
}


.dato {
    margin: 25px 5px;
    border-radius: 0 0 0 10px;
    padding: 5px 15px 0px;
    max-width: 300px;
    border-bottom: 2px solid white;
}
</style>