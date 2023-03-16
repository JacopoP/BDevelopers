<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    last: user.last,
    email: user.email,
});

</script>

<template>
    <section>
        <header>
            <h2 class="text-light">Profile Information</h2>

            <p class="mt-1 fs-6 text-light">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="d-flex flex-column gap-4">
            <div class="my_text_input_label">
                <InputLabel class="my_input_label bg-dark" for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1"
                    v-model="form.name"
                    required
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="my_text_input_label">
                <InputLabel class="my_input_label bg-dark" for="last" value="Last Name" />

                <TextInput
                    id="last"
                    type="text"
                    class="mt-1"
                    v-model="form.last"
                    required
                    autocomplete="last"
                />

                <InputError class="mt-2" :message="form.errors.last" />
            </div>

            <div class="my_text_input_label">
                <InputLabel class="my_input_label bg-dark" for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
                <p class="fs-6 mt-2 text-light">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="text-decoration-underline text-secondary rounded"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="props.status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="d-flex align-items-center gap-4">
                <PrimaryButton class="text-light" :disabled="form.processing">Save</PrimaryButton>

                <Transition>
                    <p v-if="form.recentlySuccessful" class="text-secondary m-0" style="--bs-text-opacity: .4;">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<style lang="scss">
@use '../../../../sass/guest-layout-style.scss';
</style>