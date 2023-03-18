<script setup>
import { useForm } from '@inertiajs/vue3';

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps([
    'developer',
]);

const form = useForm({
    text: null,
    email: null,
    full_name: null,
});

function submit() {
    if (form.text !== null) {
        form.post(route('message.store', props.developer.id))
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
            if(name == null){
                this.show = true;
                this.borderColorName = false;
                setTimeout(() => {
                    this.show = false;
                    this.borderColorName = true;
                }, 2000)
            }
            else if(name !== null){
                this.show = true;

                setTimeout(() => {
                    this.show = false;

                }, 2000)
            }
            if(email == null){
                this.show = true;
                this.borderColorEmail = false;
                setTimeout(() => {
                    this.show = false;
                    this.borderColorEmail = true;
                }, 2000)
            }
        }
    }
}
</script>

<template>
    <form class="d-flex flex-column align-items-center gap-4" method="post" @submit.prevent="showMessage(); submit();">

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
            <p v-if="show && form.full_name !== null && form.email !== null && form.text !== null">
                Thank you for your message!!
            </p>
            <p v-if="form.full_name == null" class="text-danger">
                Add Name
            </p>
            <p v-if="form.email == null" class="text-danger">
                Add Email
            </p>
            <p v-if="form.text == null" class="text-danger">
                Add Message Text
            </p>
        </div>
    </form>
</template>

<style lang="scss" scoped>
@use 'resources/sass/form-style.scss' as *;


</style>