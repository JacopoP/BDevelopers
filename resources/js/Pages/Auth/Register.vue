<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    last: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});
const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
const submit = () => {
    if((form.password == form.password_confirmation) && !(form.name.length > 64 || (form.name.length < 2)) && !(form.last.length > 64 || (form.last.length < 2)) && !(!form.email.match(mailformat)) && !((form.password.length < 8))){
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    }
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 w-100"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <!-- Last Verify -->
            <div v-show="form.name.length > 64 || (form.name.length < 2 && form.name.length)" class="mt-2 shadow bg-warning rounded px-3 py-2">
                <span class="text-dark fw-semibold">
                    Must be between 2 and 64 characters
                </span> 
            </div>

            <div class="mt-4">
                <InputLabel for="last" value="Last Name" />

                <TextInput
                    id="last"
                    type="text"
                    class="mt-1 w-100"
                    v-model="form.last"
                    required
                    autofocus
                    autocomplete="last"
                />

                <InputError class="mt-2" :message="form.errors.last" />
            </div>
            <!-- Last Verify -->
            <div v-show="form.last.length > 64 || (form.last.length < 2 && form.last.length)" class="mt-2 shadow bg-warning rounded px-3 py-2">
                <span class="text-dark fw-semibold">
                    Must be between 2 and 64 characters
                </span> 
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 w-100"
                    v-model="form.email"
                    required
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

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 w-100"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <!-- Password Min -->
            <div v-show="(form.password.length < 8) && form.password.length" class="mt-2 shadow bg-danger rounded px-3 py-2">
                <span class="text-light fw-semibold">
                    The Password must have at least 8 characters
                </span> 
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 w-100"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            
            <!-- Password Verify -->
            <div v-show="form.password != form.password_confirmation" class="mt-2 shadow bg-danger rounded px-3 py-2">
                <span class="text-light fw-semibold">
                    Password not matching
                </span> 
            </div>

            <div class="d-flex align-items-center justify-content-end mt-4">
                <Link
                    :href="route('login')"
                    class="text-decoration-underline fs-6 text-secondary rounded"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'text-opacity-50': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
