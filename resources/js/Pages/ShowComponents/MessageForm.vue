<script setup>
import { useForm } from '@inertiajs/vue3';

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps([
    'developer',
]);

const form = useForm({
    text: '',
    email: '',
    full_name: '',
});
// Regex
const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
function submit() {
    if ( (form.text !== '') && !(form.email.match(mailformat)) ) {
        form.post(route('message.store', props.developer.id));
        form.text = '';
        form.email = '';
        form.full_name = '';
    }
}

</script>

<script>
export default{
    data(){
        return{
            show: false,
            borderColorName: true,
            borderColorEmail: true,
            borderColorText: true,
        }
    },
    methods:{
        showMessage(name, email, text){
            // formato email è valido?
            if(name == '' || email == '' || text == ''){
                this.show = true;
            
                if(name == ''){
                    this.borderColorName = false;
                }

                if(email == ''){
                    this.borderColorEmail = false;
                }

                if(text == ''){
                    this.borderColorText = false;
                }

                setTimeout(() => {
                    this.show = false;
                    this.borderColorEmail = true;
                    this.borderColorName = true;
                    this.borderColorText = true;
                }, 10000);
            }
        }
    }
}
</script>

<template>
    <form class="d-flex flex-column align-items-center gap-4" method="post" @submit.prevent="showMessage(form.full_name, form.email, form.text); submit();">

        <!-- Username -->
        <div class="my_text_input_label w-100">

            <InputLabel class="my_input_label bg-dark" for="full_name" value="Username" />

            <TextInput
                id="full_name"
                type="text" 
                class="border bg-dark text-light rounded mt-1 w-100" 
                :class="borderColorName ? 'border-secondary' : 'border-danger'"
                v-model="form.full_name"  
                autocomplete="last"
            />

        </div>

        <!-- Email -->
        <div class="my_text_input_label w-100">

            <InputLabel class="my_input_label bg-dark" for="email" value="Your Email" />

            <TextInput
                id="email"
                type="text" 
                class="border bg-dark text-light rounded mt-1 w-100" 
                :class="borderColorEmail ? 'border-secondary' : 'border-danger'"
                v-model="form.email"  
                autocomplete="last"
            />
            <!-- Check email format -->
            <div v-show="!form.email.match(mailformat) && form.email.length">
                <div class="my_danger_alert rounded-circle bg-danger px-2">
                    <span class="text-light">!</span>
                    <span class="my_danger_alert_text mt-2 shadow bg-danger rounded text-light px-3 py-2">
                        Email format not valid
                    </span>
                </div>
            </div>
        </div>

        <!-- Message Text -->
        <div class="my_text_input_label">

            <InputLabel class="my_input_label bg-dark" for="message_text" value="Message Text" />

            <textarea

                id="message_text"
                type="text" 
                class="border border-2 border-secondary bg-dark text-light rounded mt-1 px-3 py-2 w-100" 
                :class="borderColorText ? 'border-secondary' : 'border-danger'"
                v-model="form.text"  
                autocomplete="last"
                cols="30" rows="5" 
            ></textarea>

        </div>
        <!-- Button SUBMIT -->
        <div>
            <input class="my_login_button btn btn-primary rounded-pill text-light px-3 py-2" type="submit" value="Send a Message">
        </div>
        <div v-if="show" class="fw-bold text-center text-secondary" style="--bs-text-opacity: .4;">
            <p v-if="show && form.full_name !== '' && form.email !== '' && form.text !== ''">
                Thank you for your message!!
            </p>
            <p v-if="form.full_name == ''" class="text-danger">
                Add Name
            </p>
            <p v-if="form.email == ''" class="text-danger">
                Add Email
            </p>
            <p v-if="form.text == ''" class="text-danger">
                Add Message Text
            </p>
        </div>
    </form>
</template>

<style lang="scss" scoped>
@use 'resources/sass/form-style.scss' as *;


</style>