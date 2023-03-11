<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});
// Regex
const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
const submit = () => {
    if(!(!form.email.match(mailformat)) && !((form.password.length < 8))) {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    }
};
</script>

<template>
    <GuestLayout class="container-fluid bg-dark overflow-hidden py-5">
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-success">
            {{ status }}
        </div>

        <!-- Create Account -->
        <div class="mb-4 mt-4">
            <h4 class="text-light fw-bold">Create an account</h4>
            <span class="text-light">Let's get started!</span>
        </div>

        <form @submit.prevent="submit">


            <div class="my_text_input_label">
                <InputLabel class="my_input_label bg-dark" for="email" value="Email" />

                <TextInput 
                    id="email" 
                    type="email" 
                    class="mt-1 w-100" 
                    v-model="form.email" 
                    required 
                    autofocus
                    autocomplete="username" 
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <!-- Email Verify -->
            <div v-show="!form.email.match(mailformat) && form.email.length" class="mt-2 shadow bg-secondary rounded px-3 py-2">
                <span class="text-light fw-semibold">
                    Email format not valid
                </span>
            </div>

            <div class="my_text_input_label mt-4">
                <InputLabel class="my_input_label bg-dark" for="password" value="Password" />

                <TextInput 
                    id="password" 
                    type="password" 
                    class="mt-1 w-100" 
                    v-model="form.password" 
                    required
                    autocomplete="current-password" 
                />

                <InputError class="mt-2" :message="form.errors.password" />
                <!-- Password Min -->
                <div v-show="(form.password.length < 8) && form.password.length">
                    <div class="my_danger_alert rounded-circle bg-danger px-2">
                        <span class="text-light">!</span>
                        <span class="my_danger_alert_text mt-2 shadow bg-danger rounded text-light px-3 py-2">
                            The Password must have at least 8 characters
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="d-flex align-items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 fs-6 text-secondary">Remember me</span>
                </label>
            </div>

            <div class="d-flex flex-column mt-4 gap-4">


                <PrimaryButton class="my_login_button mt-3" :class="{ 'text-opacity-50': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>

                <Link 
                    v-if="canResetPassword" 
                    :href="route('password.request')"
                    class="text-decoration-underline fs-6 text-secondary text-center"
                >
                Forgot your password?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>

<style scoped lang="scss">
@use '../../../sass/guest-layout-style.scss';
</style>
