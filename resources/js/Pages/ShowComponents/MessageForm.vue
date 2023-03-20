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
    if ( (form.name !== '') && (form.text !== '') && !(!form.email.match(mailformat)) ) {
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
            
            thereIsEmail: false,

            send_success: false,
        }
    },
    methods:{
        showMessage(name, email, format, text){
            // formato email è valido?
            if(name == '' || email == '' || !format || text == ''){
                this.show = true;
            
                if(name == ''){
                    this.borderColorName = false;
                    this.nameSend = false;
                }else{
                    this.borderColorName = true;
                }

                if(email == '' || !format){
                    this.borderColorEmail = false;
                    
                    if(email == ''){
                        this.thereIsEmail = false;
                    }else{
                        this.thereIsEmail = true;
                    }
                }else{
                    this.borderColorEmail = true;
                }
                

                if(text == ''){
                    this.borderColorText = false;
                    this.textSend = false;
                }else{
                    this.borderColorText = true;
                }

                this.send_success = false;

                setTimeout(() => {
                    this.show = false;
                    this.borderColorEmail = true;
                    this.borderColorName = true;
                    this.borderColorText = true;

                    this.thereIsEmail = true;
                    
                }, 10000);
            }else{
                this.show = true;
                this.send_success = true;
                this.borderColorEmail = true;
                this.borderColorName = true;
                this.borderColorText = true;

                this.thereIsEmail = true;
                setTimeout(() => {
                    this.show = false;
                    this.send_success = false;
                }, 10000);
            }
        }
    }
}
</script>

<template>
    <form class="d-flex flex-column align-items-center gap-4" method="post" @submit.prevent="showMessage(form.full_name, form.email, form.email.match(mailformat), form.text); submit();">

        <!-- Username -->
        <div class="my_text_input_label w-100">

            <InputLabel class="my_input_label bg-dark" for="full_name" value="Name" />

            <TextInput
                id="full_name"
                type="text" 
                class="border bg-dark text-light rounded mt-1 w-100" 
                :class="borderColorName ? 'border-secondary' : 'border-danger'"
                v-model="form.full_name"  
                autocomplete="last"
            />
            <p v-if="show && !borderColorName" class="text-danger">
                Add Name
            </p>
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
            <p v-if="show && !thereIsEmail && !borderColorEmail" class="text-danger">
                Email required
            </p>
            <p v-else-if="( show && !borderColorEmail )" class="text-danger">
                Email format not valid
            </p>
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
            <p v-if="show && !borderColorText" class="text-danger">
                Add Message Text
            </p>
        </div>
        <!-- Button SUBMIT -->
        <div>
            <input class="my_login_button btn btn-primary rounded-pill text-light px-3 py-2" type="submit" value="Send a Message">
        </div>
        <div v-if="show" class="fw-bold text-center text-secondary" style="--bs-text-opacity: .4;">
            <p v-if="send_success">
                Thank you for your message!!
            </p>
        </div>
    </form>
</template>

<style lang="scss" scoped>
@use 'resources/sass/form-style.scss' as *;


</style>