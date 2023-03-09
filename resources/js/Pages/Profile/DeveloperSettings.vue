<script setup>
import { useForm } from '@inertiajs/vue3';
// Head
import { Head } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

import ColorThief from 'colorthief/dist/color-thief.mjs';
const CORS_PROXY = 'https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&refresh=2592000&url=';


const props = defineProps({
    technologies: Array,
    developer: Object,
    developerTechnology: Array,
});

const form = useForm({
    address: props.developer.address,
    phone_number: props.developer.phone_number,
    profile_path: null,
    cv_path: null,
    portfolio_url: props.developer.portfolio_url,
    about_me: props.developer.about_me,
    performances: props.developer.performances,
    developer_technologies: ref(props.developerTechnology ? props.developerTechnology.map(tech => {
        return tech.id;
    }) : []),
});

const CT = new ColorThief();

// const img_shades = [];
props.technologies.forEach((technology) => {

    // retrieve img
    const img = new Image();
    img.crossOrigin = 'Anonymous';
    img.src = CORS_PROXY + encodeURIComponent(technology.logo_path);

    // wait for img to load
    img.addEventListener('load', () => {

        // extract dominant color
        let c = CT.getColor(img);

        function setShade(c){
            document.getElementById('img-' + technology.id).style.filter = "drop-shadow(0 0 1rem rgb(" + c[0] + "," + c[1] + "," + c[2] + "))";
            // "drop-shadow(0 0 1rem " + c + ")";
        }

        if(document.readyState !== 'loading'){
            setShade(c);
            return;
        }
        document.addEventListener('DOMContentLoaded', setShade(color));
    });

});
/* for (let technology of props.technologies) {
} */

</script>
    
<template>
    <Head title="Settings" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Developer Settings</h2>
        </template>

        <template #main>
            <!-- Form -->
            <div class="container d-flex justify-content-center my-5">
                <div class="w-50">
                    <form class="d-flex flex-column gap-3" method="post" enctype="multipart/form-data"
                        @submit.prevent="form.post(route('profile.dev.store'))">

                        <!-- Address -->
                        <div class="d-flex" v-if="form.address !== null">
                            <label for="address" class="bg-primary rounded-pill px-3 py-1">Address</label>
                        </div>
                        <input id="address" class="rounded-pill px-4" type="text" name="address" placeholder="Address"
                            v-model="form.address">

                        <!-- Phone -->
                        <div class="d-flex" v-if="form.phone_number !== null">
                            <label for="phone_number" class="bg-primary rounded-pill px-3 py-1">Phone Number</label>
                        </div>
                        <input id="phone_number" class="rounded-pill px-4" type="text" name="phone_number"
                            placeholder="PhoneNumber" v-model="form.phone_number">

                        <!-- Profile IMG -->
                        <div class="d-flex">
                            <label for="profile_path" class="bg-primary rounded-pill px-3 py-1">Profile Image</label>
                        </div>
                        <input id="profile_path" class="form-control border-dark rounded-pill" type="file"
                            name="profile_path" @input="form.profile_path = $event.target.files[0]"
                            :value="form.profile_path">
                        <!-- Profile FILE -->
                        <div class="d-flex">
                            <label for="cv_path" class="bg-primary rounded-pill px-3 py-1">CV</label>
                        </div>
                        <input id="cv_path" class="form-control border-dark rounded-pill" type="file" name="cv_path"
                            @input="form.cv_path = $event.target.files[0]">

                        <!-- URL -->
                        <div class="d-flex" v-if="form.portfolio_url !== null">
                            <label for="portfolio_url" class="bg-primary rounded-pill px-3 py-1">URL</label>
                        </div>
                        <input id="portfolio_url" class="rounded-pill px-4" type="text" name="portfolio_url"
                            placeholder="portfolio URL" v-model="form.portfolio_url">

                        <!-- About YOU -->
                        <div class="d-flex" v-if="form.about_me !== null">
                            <label for="about_me" class="bg-primary rounded-pill px-3 py-1">About ME</label>
                        </div>
                        <textarea id="about_me" class="rounded px-4" name="about_me" cols="30" rows="3"
                            placeholder="Write about you" v-model="form.about_me"></textarea>

                        <!-- Performances -->
                        <div class="d-flex" v-if="form.performances !== null">
                            <label for="performances" class="bg-primary rounded-pill px-3 py-1">Performances</label>
                        </div>
                        <textarea id="performances" class="rounded px-4" name="performances" cols="30" rows="3"
                            placeholder="Write here the jobs you offer" v-model="form.performances"></textarea>


                        <!-- Technologies section-->
                        <section class="technology">

                            <!-- subtitle -->
                            <h5 class="text-center mb-2">
                                Technologies
                            </h5>

                            <!-- section subheader -->
                            <div class="text-center mb-3">
                                <!-- known technologies list -->
                                <small v-if="form.developer_technologies.length" class="text-center text-secondary">
                                    <template v-for="(id, counter) in form.developer_technologies" class="">
                                        <template v-if="counter > 0">
                                            &#44;
                                        </template>
                                        <!-- {{ technologies[id-1].name }} -->
                                        {{ technologies.find(technology => technology.id == id).name }}
                                    </template>
                                </small>

                                <!-- placeholder for technologies list (in case no tech has been chosen) -->
                                <small v-else class="text-center text-secondary">
                                    Really? Don't you know any technology? 🤨
                                </small>
                            </div>

                            <!-- checkboxes (with GRID layout) -->
                            <div class="container">
                                <div class="row justify-content-evenly">

                                    <!-- single tech icon -->
                                    <div class="col-3 form-check d-flex align-items-center" v-for="tech in technologies">

                                        <!-- hidden (d-none) checkbox to make the checking system work -->
                                        <input class="form-check-input d-none" type="checkbox" :value="tech.id"
                                            :id="tech.id" v-model="form.developer_technologies">

                                        <!-- fake checkbox made with icon (visually toggled with dynamic class) -->
                                        <label class="form-check-label " :for="tech.id">
                                            <img :src="tech.logo_path" alt="" class="tech-icon" :id="'img-' + tech.id"
                                                :class="{ disabled: !form.developer_technologies.includes(tech.id) }">
                                        </label>

                                    </div>
                                </div>
                            </div>

                        </section>


                        <!-- Submit -->
                        <div class="d-flex justify-content-center">
                            <input class="btn btn-primary" type="submit" value="SEND">
                        </div>

                    </form>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style lang="scss">
@use 'resources/sass/general.scss' as *;

.test {
    color: $brand_primary;
}

.tech-icon {
    transition: all .15s ease-in-out;

    &:hover {
        filter: grayscale(15%);
        transform: translateY(-5px);
    }
}

.disabled {
    filter: grayscale(100%);
    opacity: .5;
    transition: all .15s ease-in-out;
    transform: scale(0.7);


    &:hover {
        filter: grayscale(85%) drop-shadow(0 0 1rem #2bce82);
        opacity: .7;
        transform: translateY(-5px);
    }
}
</style>