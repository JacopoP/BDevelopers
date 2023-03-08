<script setup>
import { useForm } from '@inertiajs/vue3';
// Head
import { Head } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


const props = defineProps({
    technologies: Array,
    developer: Object,
});
// console.log(props);

const form = useForm({
    address: props.developer.address,
    phone_number: props.developer.phone_number,
    profile_path: null,
    cv_path: null,
    portfolio_url: props.developer.portfolio_url,
    about_me: props.developer.about_me,
    performances: props.developer.performances,
   
});
// console.log(form);
</script>
    
<template>
    <Head title="Settings"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Developer Settings</h2>
        </template>

        <template #main>
            <!-- Form -->
            <a :href="route('profile.dev.delete')">X</a>
            <div class="container d-flex justify-content-center my-5">
                <div class="w-50">
                    <form class="d-flex flex-column gap-3" method="post" enctype="multipart/form-data"
                        @submit.prevent="form.post(route('profile.dev.store'))">
        
                        <!-- Address -->
                        <div class="d-flex" v-if="form.address !== null">
                            <label for="address" class="bg-primary rounded-pill px-3 py-1">Address</label>
                        </div>
                        <input id="address" class="rounded-pill px-4" type="text" name="address" placeholder="Address" v-model="form.address">
        
                        <!-- Phone -->
                        <div class="d-flex" v-if="form.phone_number !== null">
                            <label for="phone_number" class="bg-primary rounded-pill px-3 py-1">Phone Number</label>
                        </div>
                        <input id="phone_number" class="rounded-pill px-4" type="text" name="phone_number" placeholder="PhoneNumber" v-model="form.phone_number">
        
                        <!-- Profile IMG -->
                        <div class="d-flex">
                            <label for="profile_path" class="bg-primary rounded-pill px-3 py-1">Profile Image</label>
                        </div>
                        <input id="profile_path" class="form-control border-dark rounded-pill" type="file" name="profile_path" @input="form.profile_path = $event.target.files[0]" :value="form.profile_path">
                        <!-- Profile FILE -->
                        <div class="d-flex">
                            <label for="cv_path" class="bg-primary rounded-pill px-3 py-1">CV</label>
                        </div>
                        <input id="cv_path" class="form-control border-dark rounded-pill" type="file" name="cv_path" @input="form.cv_path = $event.target.files[0]">
        
                        <!-- URL -->
                        <div class="d-flex" v-if="form.portfolio_url !== null">
                            <label for="portfolio_url" class="bg-primary rounded-pill px-3 py-1">URL</label>
                        </div>
                        <input id="portfolio_url" class="rounded-pill px-4" type="text" name="portfolio_url" placeholder="portfolio URL" v-model="form.portfolio_url">
        
                        <!-- About YOU -->
                        <div class="d-flex" v-if="form.about_me !== null">
                            <label for="about_me" class="bg-primary rounded-pill px-3 py-1">About ME</label>
                        </div>
                        <textarea id="about_me" class="rounded px-4" name="about_me" cols="30" rows="3" placeholder="Write about you" v-model="form.about_me"></textarea>
        
                        <!-- Performances -->
                        <div class="d-flex" v-if="form.performances !== null">
                            <label for="performances" class="bg-primary rounded-pill px-3 py-1">Performances</label>
                        </div>
                        <textarea id="performances" class="rounded px-4" name="performances" cols="30" rows="3" placeholder="Write here the jobs you offer" v-model="form.performances"></textarea>
        
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
</style>