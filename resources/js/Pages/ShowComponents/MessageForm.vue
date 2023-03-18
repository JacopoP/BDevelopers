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
        }
    },
    methods:{
        showMessage(){
            this.show = true;
            setTimeout(() => {
                this.show = false;
            }, 2000)
        }
    }
}
</script>

<template>
    <form class="d-flex flex-column gap-4" method="post" @submit.prevent="submit">

        <!-- Username -->
        <div class="my_text_input_label">

            <InputLabel class="my_input_label bg-dark" for="full_name" value="Username" />

            <TextInput
                id="full_name"
                type="text" 
                class="border bg-dark text-light rounded mt-1 w-100" 
                v-model="form.full_name"  
                autocomplete="last"
            />

        </div>

        <!-- Email -->
        <div class="my_text_input_label">

            <InputLabel class="my_input_label bg-dark" for="email" value="Your Email" />

            <TextInput
                id="email"
                type="text" 
                class="border bg-dark text-light rounded mt-1 w-100" 
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
                v-model="form.text"  
                autocomplete="last"
                cols="30" rows="5" 
            ></textarea>

        </div>

        <input @click="showMessage()" class="btn _button btn-primary rounded-pill _blue text-light" type="submit" value="Send a Message">
    </form>
    <div v-if="show && form.full_name !== null && form.email !== null && form.text !== null" class="fw-bold text-center text-secondary" style="--bs-text-opacity: .4;">
        <p>
            Thank you for your message!!
        </p>
    </div>
</template>

<style lang="scss" scoped>
// @use 'resources/sass/variable.scss' as *;
@use '../../../../resources/sass/devShow-layout-style.scss' as *;
@use '../../../../resources/sass/form-style.scss';

label {
    position: relative;
    top: 10px;
    background: $brand_background;
    padding: 0 8px;
}

.layout {
    width: 100%;
    border-radius: 10px;
}

._button {
    padding: 10px;
    border-radius: 20px;
    margin-top: 15px;
    width: 100%;
}
</style>