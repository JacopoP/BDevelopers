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

// File Input

</script>
    
<template>
    <Head title="Settings" />
    <AuthenticatedLayout class="overflow-hidden">

        <template #header>
            <div class="d-flex justify-content-between">
                <h2>Developer Settings</h2>
                <a :href="route('profile.dev.delete')"
                    class="btn btn-danger text-light fw-bold d-flex align-items-center">Delete</a>
            </div>
        </template>

        <template #main>
            <!-- Form -->
            <div class="container d-flex flex-column align-items-center my-5">
                <div class="w-50">
                    <form class="d-flex flex-column gap-4" method="post" enctype="multipart/form-data"
                        @submit.prevent="form.post(route('profile.dev.store'))">


                        <!-- Address -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="address" value="Address" />

                            <TextInput placeholder="address" id="address" type="address" class="mt-1 w-100 p-2"
                                v-model="form.address" autocomplete="username" />
                        </div>


                        <!-- Phone -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="phone_number" value="Phone Number" />

                            <TextInput placeholder="phone_number" id="phone_number" type="phone_number"
                                class="mt-1 w-100 p-2" v-model="form.phone_number" autocomplete="username" />
                        </div>


                        <div class="d-flex flex-column gap-4 py-4">
                            <!-- Profile IMG -->
                            <div class="d-flex flex-column align-items-center gap-4">
                                <div class="mx-auto">
                                    <label for="profile_path"
                                        class="my_login_button px-3 py-1 rounded-pill text-light cursor-pointer">Upload
                                        Image</label>
                                </div>
                                <input id="profile_path" class="form-control border-dark px-4 py-3" type="file"
                                    name="profile_path" @input="form.profile_path = $event.target.files[0]">
                            </div>

                            <!-- Profile FILE -->
                            <div class="d-flex flex-column align-items-center gap-4">
                                <div class="mx-auto">
                                    <label for="cv_path"
                                        class="my_login_button rounded-pill text-light px-3 py-1 cursor-pointer">Curriculum
                                        Vitae</label>
                                </div>
                                <input id="cv_path" class="form-control border-dark px-4 py-3" type="file" name="cv_path"
                                    @input="form.cv_path = $event.target.files[0]">
                            </div>
                        </div>


                        <!-- URL -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="portfolio_url" value="Portfolio URL" />

                            <TextInput placeholder="portfolio_url" id="portfolio_url" type="portfolio_url"
                                class="mt-1 w-100 p-2" v-model="form.portfolio_url" autocomplete="username" />
                        </div>


                        <!-- About ME -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="about_me" value="About ME" />

                            <textarea id="about_me" class="bg-dark text-light rounded px-4 w-100 border-secondary py-3"
                                style="padding-left: 1rem !important;" name="about_me" cols="30" rows="3"
                                placeholder="Write about you" v-model="form.about_me">
                                </textarea>
                        </div>


                        <!-- Performances -->
                        <div class="my_text_input_label">
                            <InputLabel class="my_input_label bg-dark" for="performances" value="Performances" />

                            <textarea id="performances" class="bg-dark text-light rounded px-4 w-100 border-secondary py-3"
                                style="padding-left: 1rem !important;" name="performances" cols="30" rows="3"
                                placeholder="About your Job" v-model="form.performances">
                                </textarea>
                        </div>


                        <!-- Technologies section-->
                        <section class="technology">

                            <!-- subtitle -->
                            <div class="d-flex justify-content-center">
                                <h5 class="my_register_button text-center fw-bold rounded-pill text-light mb-2 px-3 py-2">
                                    Technologies
                                </h5>
                            </div>

                            <!-- section subheader -->
                            <div class="text-center mb-3">
                                <!-- known technologies list -->
                                <small v-if="form.developer_technologies.length" class="text-center text-secondary">
                                    <template v-for="(id, counter) in form.developer_technologies">
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
                            <div>
                                <div
                                    class="row row-cols-2 row-cols-md-3 row-cols-lg-5 justify-content-evenly gap-y-5 mt-5 border border-secondary border-4 rounded py-4 overflow-auto">

                                    <!-- single tech icon -->
                                    <div class="d-flex justify-content-center align-items-center"
                                        v-for="tech in technologies">

                                        <!-- hidden (d-none) checkbox to make the checking system work -->
                                        <input class="form-check-input d-none" type="checkbox" :value="tech.id"
                                            :id="tech.id" v-model="form.developer_technologies">

                                        <!-- fake checkbox made with icon (visually toggled with dynamic class) -->
                                        <label class="form-check-label text-center" :for="tech.id">
                                            <div class="my_tech_icon">
                                                <img :src="tech.logo_path" alt="" class="tech-icon" :id="'img-' + tech.id"
                                                    :class="{ disabled: !form.developer_technologies.includes(tech.id) }">
                                            </div>
                                            <span class="text-light fw-bold">{{ tech.name }}</span>
                                        </label>

                                    </div>
                                </div>
                            </div>

                        </section>


                        <!-- Submit -->
                        <div class="d-flex justify-content-center"
                            v-if="form.address == null && form.phone_number == null && form.portfolio_url == null && form.about_me == null && form.performances == null">
                            <input class="my_login_button btn btn-secondary rounded-pill text-light border-0" type="submit"
                                value="SEND">
                        </div>
                        <!-- Update -->
                        <div class="d-flex justify-content-center" v-else>
                            <input class="my_login_button btn btn-secondary rounded-pill text-light border-0" type="submit"
                                value="UPDATE">
                        </div>

                    </form>

                </div>

            </div>


        </template>

    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>
@use 'resources/sass/variable.scss' as *;
@use 'resources/sass/form-style.scss';

.disabled {
    filter: grayscale(100%);
    opacity: .5;
    transition: all .15s ease-in-out;
    transform: scale(0.7);


    &.my_tech_icon:hover .tech-icon {
        filter: grayscale(85%) drop-shadow(0 0 1rem #2bce82);
        opacity: .7;
        transform: translateY(-5px);
    }
}

.tech-icon {
    transition: all .15s ease-in-out;
    cursor: pointer;

    &:hover {
        filter: grayscale(15%);
        transform: translateY(-5px);
    }
}

// To remove from display input file 
// input[type="file"] {
//     display: none;
// }
input[type=file] {
    border-radius: 10px;
    background: $brand_primary;
    color: #fff;
    font-weight: 500;
}

input[type=file]:hover {
    transition: .4s ease-in-out;
    color: $brand_primary;
    background: $brand_secondary;
}

input[type=file]::file-selector-button {
    margin-right: 20px;
    border: none;
    background: $brand_fourth;
    padding: 10px 20px;
    border-radius: 15px;
    color: #fff;
    cursor: pointer;
}

input[type=file]:hover::file-selector-button {
    transition: .4s ease-in-out;
    color: $brand_fourth;
}



// TechIcon
.my_tech_icon {
    width: 80px;
    height: 80px;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: $brand_secondary;
    border-radius: 50%;

}

.my_tech_icon:hover .tech-icon {
    filter: grayscale(15%);
    transform: translateY(-5px);
}

img {
    width: 100%;
}</style>