<script setup>
import { useForm } from '@inertiajs/vue3';
import ReviewForm from '@/Pages/ShowComponents/ReviewForm.vue'
import MessageForm from '@/Pages/ShowComponents/MessageForm.vue'
import RatingForm from '@/Pages/ShowComponents/RatingForm.vue'
const props = defineProps([
    'developer',
]);

const dati = {
    name: props.developer.user.name,
    last: props.developer.user.last,
    address: props.developer.address,
    profile_path: props.developer.profile_path,
};

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
    
<template>
    <h1>Developers</h1>
    <ul>
        <li>Cognome: {{ dati.last }}</li>
        <li>Nome: {{ dati.name }}</li>
    </ul>
    <img :src="dati.profile_path">

    <h2>Review</h2>
    <ReviewForm :developer="developer" />
    <br>
    <h2>Rating</h2>
    <RatingForm :developer="developer" />
    <br>
    <h2>Message</h2>
    <MessageForm :developer="developer" />
</template>

<style lang="scss">
@use 'resources/sass/general.scss' as *;

body {
    padding: 20px;
}

.test {
    color: $brand_primary;
}

img {
    width: 100px
}

.my_input {
    border-radius: 30px;
    padding: 10px 20px;
}
</style>