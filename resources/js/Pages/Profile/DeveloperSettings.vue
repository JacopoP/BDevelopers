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

        <!-- Form -->
        <div class="container d-flex justify-content-center mt-3">
            <div class="w-50">
                <form class="d-flex flex-column gap-3" method="post" enctype="multipart/form-data"
                    @submit.prevent="form.post(route('profile.dev.store'))">
    
                    <!-- Address -->
                    <input class="rounded-pill px-4" type="text" name="address" placeholder="Address" v-model="form.address">
    
                    <!-- Phone -->
                    <input class="rounded-pill px-4" type="text" name="phone_number" placeholder="PhoneNumber" v-model="form.phone_number">
    
                    <!-- Profile IMG -->
                    <input class="form-control border-dark rounded-pill" type="file" name="profile_path" @input="form.profile_path = $event.target.files[0]" :value="form.profile_path">
                    <!-- Profile FILE -->
                    <input class="form-control border-dark rounded-pill" type="file" name="cv_path" @input="form.cv_path = $event.target.files[0]">
    
                    <!-- URL -->
                    <input class="rounded-pill px-4" type="text" name="portfolio_url" placeholder="portfolio URL" v-model="form.portfolio_url">
    
                    <!-- About YOU -->
                    <textarea class="rounded px-4" name="about_me" cols="30" rows="3" placeholder="Write about you" v-model="form.about_me"></textarea>
    
                    <!-- Performances -->
                    <textarea class="rounded px-4" name="performances" cols="30" rows="3" placeholder="Write here the jobs you offer" v-model="form.performances"></textarea>
    
                    <!-- Submit -->
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-primary" type="submit" value="SEND">
                    </div>
                    
                </form>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style lang="scss">
@use 'resources/sass/general.scss' as *;

.test {
    color: $brand_primary;
}
</style>