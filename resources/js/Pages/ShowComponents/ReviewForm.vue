<script setup>
import { useForm } from '@inertiajs/vue3';

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps([
    'developer',
]);

const form = useForm({
    text: '',
    full_name: '',
});

function submit() {
    if (form.text !== '') {
        form.post(route('review.store', props.developer.id));
        // Clear Form
        form.full_name = '';
        form.text = '';
    }
}

</script>

<script>
export default{
    data(){
        return{
            show: false,
            borderColor: true,
            send_success: false
        }
    },
    methods:{
        showMessage(e){
            if(e == ''){
                this.show = true;
                this.send_success = false;
                this.borderColor = false;
                setTimeout(() => {
                    this.show = false;
                    this.borderColor = true;
                }, 10000)
            }
            else if(e !== ''){
                this.show = true;
                this.send_success = true;
                this.borderColor = true;
                setTimeout(() => {
                    this.show = false;
                }, 10000)
            }
        },

    }
}
</script>

<template>
    <div>
        <form class="d-flex flex-column align-items-center gap-4" method="post" @submit.prevent="showMessage(form.text); submit(); $emit('updateReviews')">
            
            <div class="my_text_input_label w-100">
    
                <InputLabel class="my_input_label bg-dark" for="full_name" value="Name" />
    
                <TextInput
                    id="full_name"
                    type="text" 
                    class="border bg-dark text-light rounded mt-1 w-100" 
                    v-model="form.full_name"  
                    autocomplete="last"
                />
    
            </div>
    
            <div class="my_text_input_label w-100">
    
                <InputLabel class="my_input_label bg-dark" for="text" value="Text" />
    
                <textarea 
                    id="text"
                    type="text" 
                    :class="borderColor ? 'border-secondary' : 'border-danger'"
                    class="border border-2 bg-dark text-light rounded mt-1 px-3 py-2 w-100" 
                    v-model="form.text"  
                    autocomplete="last"
                    cols="30" rows="5" 
                ></textarea>
                
            </div>
    
            <!-- Button SUBMIT -->
            <div>
                <input class="my_login_button btn btn-primary rounded-pill text-light px-3 py-2" type="submit" value="Send a Review">
            </div>
    
        </form>
    
        <div v-if="show" class="fw-bold text-center text-secondary" style="--bs-text-opacity: .4;">
            <p v-if="send_success">
                Thank you for your review!!
            </p>
            <p v-else class="fw-bold text-danger">
                Add Text
            </p>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use 'resources/sass/form-style.scss';
</style>