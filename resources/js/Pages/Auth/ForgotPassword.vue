<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout class="bg-dark">
        <Head title="Forgot Password" />

        <div class="my-4 text-secondary fs-6">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="mb-4 text-success">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="mx-auto" style="max-width: 500px;">
            <div class="my_text_input_label">
                <InputLabel class="my_input_label bg-dark" for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 w-100 text-light"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="d-flex justify-content-center mt-4">
                <PrimaryButton class="my_login_button" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>


