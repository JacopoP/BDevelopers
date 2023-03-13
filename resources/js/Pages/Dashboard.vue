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
    profile_path: props.developer.profile_path,
};

</script>

<template>
    <div class="d-flex justify-between">
        <h1>Your profile</h1>
        <div>
            <div>
                <a href="/profile">Profile</a>
            </div>
            <div>
                <a href="/index">index</a>
            </div>
        </div>
    </div>
    <div class="container DEBUG-yellow">

        <div class="d-flex justify-between">
            <div class="sinistra DEBUG-blue">
                <div>
                    {{ data.name }}
                </div>
                <div>
                    {{ data.last }}
                </div>
                <div>
                    {{ data.address }}
                </div>
            </div>
            <div class="destra DEBUG-green">
                <div class="my-img-container DEBUG-pink">

                    <img :src="data.profile_path">
                </div>
            </div>
        </div>
    </div>
</template>


<style>
body {
    background-color: #212529;
}

h1 {
    color: white;
}

.my-img-container {
    /* width: 300px;
    height: 300px; */
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    padding: 10px;


}


img {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 30%;
}

.sinistra {
    width: 100%;
    color: white;
}

.destra {
    padding: 0 10px;
    width: 40%;
    display: flex;
    justify-content: center;
    /* align-items: center; */
}


/* DEBUG */
/* .DEBUG-yellow {
    background-color: rgba(255, 255, 0, 0.263)
}

.DEBUG-blue {
    background-color: rgba(0, 0, 255, 0.251);
}

.DEBUG-green {
    background-color: rgba(0, 128, 0, 0.215);
}

.DEBUG-pink {
    background-color: rgb(255, 192, 203);
} */
</style>