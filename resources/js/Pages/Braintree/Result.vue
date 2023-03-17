<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps(['result', 'developer']);
console.log(props.result);
console.log(props.developer);
</script>

<template>
    <GuestLayout class="bg-dark overflow-hidden">
        <div class="my_container">
            <template v-if="result.success">
                <h1 class="text-success">Congratulation! You are now sponsored</h1>
                <div class="d-flex justify-content-center gap-3 pt-5">
                    <Link :href="route('home')" class="btn btn-light">Go to homepage</Link>
                    <Link :href="route('braintree')" class="btn btn-light">Buy another sponsor plan</Link>
                    <Link :href="route('dashboard')" class="btn btn-light">Go to dashborad</Link>
                </div>
            </template>
            <template v-else>
                <h1 class="text-danger">Transaction failed</h1>
                <div class="d-flex justify-content-center gap-3 pt-5">
                    <Link :href="route('home')" class="btn btn-light">Go to homepage</Link>
                    <Link :href="route('braintree')" class="btn btn-light">Retry</Link>
                    <Link :href="route('dashboard')" class="btn btn-light">Go to dashborad</Link>
                </div>
            </template>
        </div>
    </GuestLayout>
</template>

<style lang="scss" scoped>
h1{
    margin-top: 20vh;
    font-size: calc(1.35rem + 1.5vw);
}
</style>