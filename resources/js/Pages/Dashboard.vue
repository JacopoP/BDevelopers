<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';



const props = defineProps([
    'developer'
]);



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
    reviews: props.developer.reviews, 
};
console.log(data.text);
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
            <div class="container">
        
                <main class="d-flex justify-between DEBUG">
                    <div class="sinistra  overflow-scroll DEBUG">
        
                        <div class="spazi DEBUG">
                            <label>
                                My reviews
                            </label>
                            <div class="testo">
                                <ul>
                                    <li v-for="review in data.reviews">
                                        <span v-if="review.full_name != undefined">{{ review.full_name }} <br></span>
                                        {{ review.text }}
                                    </li>
                                </ul>
                            </div>
                        </div>
        
                    </div>
                    <div class="destra DEBUG">
                        <div class="my-img-container DEBUG">
        
                            <img :src="'storage/' + data.profile_path">
        
        
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
                            <div class="spazi DEBUG" v-if="data.about_me">
                                <label>
                                    About me
                                </label>
                                <div class="testo">
                                    {{ data.about_me }}
                                </div>
                            </div>
                            <div class="spazi DEBUG" v-if="data.performances">
                                <label>
                                    My performances
                                </label>
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
        </template>

    </AuthenticatedLayout>
</template>


<style lang="scss" scoped>
$grigio-sfondo: #212529;
$color-scritte: rgb(255, 255, 255);
$color-titoli: rgb(255, 251, 0);
$h-header: 100px;
$h-main: calc(98vh - $h-header);



// debug
$DEBUG: rgba(255, 255, 255, 0.244);

// .DEBUG {
//     border: 1px solid green;
//     background-color: $DEBUG;
// }




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

.spazi {
    border: 1px solid white;
    border-radius: 0 0 10px 0;
    padding: 10px;
    position: relative;

    label {
        background-color: $grigio-sfondo;
        padding: 0 8px;
        position: absolute;
        top: -13px;
        left: -8px;
        font-size: 12px;
        color: $color-titoli;

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
    background-color: $grigio-sfondo;
    color: $color-scritte;
    position: relative;

    header {
        height: $h-header;

        h1 {
            color: white;
        }
    }

    main {
        height: $h-main;



        .sinistra {
            margin: 10px;
            width: 100%;



            .spazi {
                margin: 50px 0;

                label {

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


            .spazi {

                margin: 70px 0;

            }
        }
    }
}
</style>