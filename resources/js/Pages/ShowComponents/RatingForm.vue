<script setup>
import { useForm } from '@inertiajs/vue3';
const props = defineProps([
    'developer',
]);

const form = useForm({
    rating: null,
});
</script>

<template>
    <form method="post" @submit.prevent="form.post(route('rating.store', developer.id))">
    <div class="slidecontainer">
        <input type="range" min="1" max="5" v-model="form.rating" class="slider" id="rating">
            <br>
        </div>
        <span>Quante Stelle: {{ form.rating }} </span>
        <!-- <br>
                                                        <select class="layout" v-model="form.rating" id="rating">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select> -->
        <br>
        <input class="_button _blue" type="submit" value="Send Rating">
    </form>
</template>


<style lang="scss" scoped>
@use 'resources/sass/general.scss' as *;

.layout {
    width: 100%;
    background-color: $background;
    border-radius: 10px;
}

._button {
    color: $titles;
    padding: 10px;
    border-radius: 20px;
    margin-top: 15px;
    width: 100%;
}
</style>
