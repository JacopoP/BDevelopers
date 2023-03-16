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
    <div class="d-flex align-items-center gap-3">
        <input type="range" min="1" max="5" v-model="form.rating" id="rating">
        <span class="text-light">{{ form.rating }}</span>
    </div>

        <input class="btn _button btn-primary rounded-pill _blue text-light" type="submit" value="Send Rating">
    </form>
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
