<script setup>
import { useForm } from '@inertiajs/vue3';

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps([
    'developer',
]);

const form = useForm({
    text: null,
    full_name: null,
});

function submit() {
    if (form.text !== null) {
        form.post(route('review.store', props.developer.id))
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

        <div class="my_text_input_label">

            <InputLabel class="my_input_label bg-dark" for="text" value="Text" />

            <textarea 
                id="text"
                type="text" 
                class="border border-2 border-secondary bg-dark text-light rounded mt-1 px-3 py-2 w-100" 
                v-model="form.text"  
                autocomplete="last"
                cols="30" rows="5" 
            ></textarea>

        </div>


        <input @click="showMessage()" class="btn _button btn-primary rounded-pill my_login_button text-light" type="submit" value="Send a Review">

    </form>
    <div v-if="show && form.text !== null" class="fw-bold text-center text-secondary" style="--bs-text-opacity: .4;">
        <p>
            Thank you for your review!!
        </p>
    </div>
</template>

<style lang="scss" scoped>
// @use 'resources/sass/variable.scss' as *;
@use '../../../../resources/sass/devShow-layout-style.scss' as *;
@use '../../../../resources/sass/form-style.scss';

.layout {
    width: 100%;
    border-radius: 10px;
}

label {
    position: relative;
    top: 10px;
    background: $brand_background;
    padding: 0 8px;
}

._button {
    padding: 10px;
    border-radius: 20px;
    margin-top: 15px;
    width: 100%;
}
</style>