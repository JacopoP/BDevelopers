<script setup>
import StarRating from 'vue-star-rating';
import { useForm } from '@inertiajs/vue3';
const props = defineProps([
    'developer',
]);

const form = useForm({
    rating: null,
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
    <form method="post" @submit.prevent="form.post(route('rating.store', developer.id))">
        <div class="d-flex align-items-center gap-3">
            <!-- <input type="range" min="1" max="5" v-model="form.rating" id="rating"> -->
            <!-- <span class="text-light">{{ form.rating }}</span> -->
            <div style="display:inline-block;">
                <star-rating class="text-light" 
                v-model:rating="form.rating"
                :animate="true" 
                :active-color="['#410000', '#410000', '#f7a531']" 
                :border-width="0" 
                :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]" 
                :active-on-click="true" 
                :clearable="true" 
                :show-rating="false"
                :star-size="25"
                ></star-rating>
            </div>
        </div>
        <input @click="showMessage()" class="btn _button btn-primary rounded-pill _blue text-light" type="submit" value="Send Rating">
    </form>
    <div v-if="show" class="fw-bold text-center text-secondary" style="--bs-text-opacity: .4;">
        <p>
            Saved
        </p>
    </div>
</template>


<style lang="scss" scoped>
// @use 'resources/sass/variable.scss' as *;
@use '../../../../resources/sass/devShow-layout-style.scss' as *;

.layout {
    width: 100%;
    background-color: $brand_primary;
    border-radius: 10px;
}

._button {
    padding: 10px;
    border-radius: 20px;
    margin-top: 15px;
    width: 100%;
}
</style>
