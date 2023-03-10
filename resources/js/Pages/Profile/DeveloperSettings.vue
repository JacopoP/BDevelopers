<script setup>
import { useForm } from '@inertiajs/vue3';
// Head
import { Head } from '@inertiajs/vue3';
// FORM
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

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

        function setShade(c) {
            document.getElementById('img-' + technology.id).style.filter = "drop-shadow(0 0 1rem rgb(" + c[0] + "," + c[1] + "," + c[2] + "))";
            // "drop-shadow(0 0 1rem " + c + ")";
        }

        if (document.readyState !== 'loading') {
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
            <div class="d-flex justify-content-between">
                <h2>Developer Settings</h2>
                <a :href="route('profile.dev.delete')" class="btn btn-danger text-light fw-bold">Delete</a>
            </div>
        </template>

        <template #main>
            <!-- Form -->
            <div class="container d-flex justify-content-center my-5">
                <div class="w-50">
                    <form class="d-flex flex-column gap-4" method="post" enctype="multipart/form-data"
                        @submit.prevent="form.post(route('profile.dev.store'))">


                        <!-- Address -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="address" value="Address" />

                            <TextInput
                                placeholder="address"
                                id="address"
                                type="address"
                                class="mt-1 w-100 p-2"
                                v-model="form.address"
                                required
                                autofocus
                                autocomplete="username"
                            />
                        </div>


                        <!-- Phone -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="phone_number" value="Phone Number" />

                            <TextInput
                                placeholder="phone_number"
                                id="phone_number"
                                type="phone_number"
                                class="mt-1 w-100 p-2"
                                v-model="form.phone_number"
                                required
                                autofocus
                                autocomplete="username"
                            />
                        </div>
                        
                        
                        <!-- Profile IMG -->
                        <div class="mx-auto">
                            <label for="profile_path" class="bg-primary px-3 py-1 rounded-pill text-light cursor-pointer">Upload Image</label>
                        </div>
                        <input id="profile_path" class="form-control border-dark rounded-pill" type="file"
                            name="profile_path" @input="form.profile_path = $event.target.files[0]"
                            :value="form.profile_path"
                        >

                        <!-- Profile FILE -->
                        <div class="mx-auto">
                            <label for="cv_path" class="bg-primary rounded-pill text-light px-3 py-1">CV</label>
                        </div>
                        <input id="cv_path" class="form-control border-dark rounded-pill" type="file" name="cv_path"
                            @input="form.cv_path = $event.target.files[0]"
                        >
                        

                        <!-- URL -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="portfolio_url" value="Portfolio URL" />

                            <TextInput
                                placeholder="portfolio_url"
                                id="portfolio_url"
                                type="portfolio_url"
                                class="mt-1 w-100 p-2"
                                v-model="form.portfolio_url"
                                required
                                autofocus
                                autocomplete="username"
                            />
                        </div>


                        <!-- About ME -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="about_me" value="About ME" />

                            <textarea id="about_me" class="bg-dark text-light rounded px-4 w-100" name="about_me" cols="30" rows="3"
                                placeholder="Write about you" v-model="form.about_me">
                            </textarea>
                        </div>


                        <!-- Performances -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="performances" value="Performances" />

                            <textarea id="performances" class="bg-dark text-light rounded px-4 w-100" name="performances" cols="30" rows="3"
                                placeholder="About your Job" v-model="form.performances">
                            </textarea>
                        </div>


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

// To remove from display input file 
input[type="file"] {
    display: none;
}
</style>