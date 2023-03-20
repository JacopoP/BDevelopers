<script setup>
import StarRating from 'vue-star-rating';
import { useForm } from '@inertiajs/vue3';
const props = defineProps([
    'developer',
]);

const form = useForm({
    rating: 3,
});
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
    <form class="d-flex flex-column gap-4" method="post" @submit.prevent="showMessage(); form.post(route('rating.store', developer.id));">
        <div class="d-flex align-items-center gap-3">

            <div class="my_login_button rounded p-4">
                <star-rating class="text-light" 
                v-model:rating="form.rating"
                :animate="true" 
                :active-color="['#410000', '#410000', '#f7a531']" 
                :border-width="0" 
                :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]" 
                :active-on-click="true" 
                :clearable="false" 
                :show-rating="false"
                :star-size="25"
                ></star-rating>
            </div>

        </div>
        <!-- Button SUBMIT -->
        <input class="my_login_button btn btn-primary rounded-pill text-light px-3 py-2" type="submit" value="Send Rating">
    </form>
    <div v-if="show" class="fw-bold text-center text-secondary" style="--bs-text-opacity: .4;">
        <p>
            Saved
        </p>
    </div>
</template>


<style lang="scss" scoped>
@use 'resources/sass/form-style.scss' as *;
</style>
