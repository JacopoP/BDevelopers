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
// Regex
const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
const submit = () => {
    if((form.password == form.password_confirmation) && !(form.name.length > 64 || (form.name.length < 2)) && !(form.last.length > 64 || (form.last.length < 2)) && !(!form.email.match(mailformat)) && !((form.password.length < 8))){
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    }
};
</script>

<!-- Show password -->
<script>
    export default{
        data(){
            return{
                // Password view func
                view: false,
            }
        },

        methods:{
            setView(){
                this.view = !this.view;
            }
        }

    }
</script>

<template>
    <GuestLayout class="container-fluid bg-dark overflow-hidden py-5">
        <Head title="Register" />

        <!-- Create Account -->
        <div class="mb-4 mt-4">
            <h4 class="text-light fw-bold">Create an account</h4>
            <span class="text-light">Let's get started!</span>
        </div>

        <form @submit.prevent="submit">
            <div class="my_text_input_label mt-5">
                <InputLabel class="my_input_label bg-dark" for="name" value="Name" />

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
                <!-- Last Verify -->
                <div v-show="form.name.length > 64 || (form.name.length < 2 && form.name.length)">
                    <div class="my_warning_alert rounded-circle bg-warning px-2">
                        <span class="text-dark">!</span>
                        <span class="my_warning_alert_text mt-2 shadow bg-warning rounded text-dark px-3 py-2">
                            Must be between 2 and 64 characters
                        </span>
                    </div>
                </div>
            </div>

            <div class="my_text_input_label mt-4">
                <InputLabel class="my_input_label bg-dark" for="last" value="Last Name" />

                <TextInput 
                    id="last" 
                    type="text" 
                    class="mt-1 w-100" 
                    v-model="form.last" 
                    required 
                    autocomplete="last" 
                />

                <InputError class="mt-2" :message="form.errors.last" />
                <!-- Last Verify -->
                <div v-show="form.last.length > 64 || (form.last.length < 2 && form.last.length)">
                    <div class="my_warning_alert rounded-circle bg-warning px-2">
                        <span class="text-dark">!</span>
                        <span class="my_warning_alert_text mt-2 shadow bg-warning rounded text-dark px-3 py-2">
                            Must be between 2 and 64 characters
                        </span>
                    </div>
                </div>
            </div>

            <div class="my_text_input_label mt-4">
                <InputLabel class="my_input_label bg-dark" for="email" value="Email" />

                <TextInput 
                    id="email" 
                    type="email" 
                    class="mt-1 w-100" 
                    v-model="form.email" 
                    required
                    autocomplete="username" 
                />

                <InputError class="mt-2" :message="form.errors.email" />
                <!-- Email Verify -->
                <div v-show="!form.email.match(mailformat) && form.email.length">
                    <div class="my_danger_alert rounded-circle bg-danger px-2">
                        <span class="text-light">!</span>
                        <span class="my_danger_alert_text mt-2 shadow bg-danger rounded text-light px-3 py-2">
                            Email format not valid
                        </span>
                    </div>
                </div>
            </div>

            <div class="my_text_input_label mt-4">
                <InputLabel class="my_input_label bg-dark" for="password" value="Password" />

                <TextInput 
                    id = "password" 
                    :type="this.view ? 'text' : 'password'" 
                    class="mt-1 w-100" 
                    v-model="form.password" 
                    required
                    :autocomplete="this.view ? 'off' : 'current-password'"
                />

                <button v-if="this.view == false" type="button" class="my_password_view text-light btn" @click="setView()">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <button v-if="this.view == true" type="button" class="my_password_view text-light btn" @click="setView()">
                    <i class="fa-solid fa-eye-slash"></i>
                </button>

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

            <div class="my_text_input_label mt-4">
                <InputLabel class="my_input_label bg-dark" for="password_confirmation" value="Confirm Password" />

                <TextInput 
                    id="password_confirmation" 
                    :type="this.view ? 'text' : 'password'" 
                    class="mt-1 w-100"
                    v-model="form.password_confirmation" 
                    required 
                    :autocomplete="this.view ? 'off' : 'new-password'"
                />

                <button v-if="this.view == false" type="button" class="my_password_view text-light btn" @click="setView()">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <button v-if="this.view == true" type="button" class="my_password_view text-light btn" @click="setView()">
                    <i class="fa-solid fa-eye-slash"></i>
                </button>
                
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                
                <!-- Password Verify -->
                <div v-show="form.password != form.password_confirmation">
                    <div class="my_danger_alert rounded-circle bg-danger px-2">
                        <span class="text-light">!</span>
                        <span class="my_danger_alert_text mt-2 shadow bg-danger rounded text-light px-3 py-2">
                            Password not matching
                        </span>
                    </div>
                </div>
            </div>


            <div class="d-flex flex-column mt-4 gap-4">

                <PrimaryButton class="my_login_button" :style="{ 'opacity: .5': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>

                <Link 
                    :href="route('login')" 
                    class="text-decoration-underline fs-6 text-secondary text-center"
                >
                Already registered?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>


<style scoped lang="scss">
@use '../../../sass/guest-layout-style.scss';
</style>
