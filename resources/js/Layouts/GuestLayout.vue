<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<!-- Login/Register Pages -->
<template>
    <div class="d-flex flex-column justify-content-top align-items-center position-relative" id="my_container">
        <div>
            <Link href="/">
            <ApplicationLogo />
            </Link>
        </div>

        <div>
            <slot />
        </div>
        <div class="my_square"></div>
        <div class="my_circle"></div>
    </div>
</template>

<style scoped lang="scss">
@use '../../sass/guest-layout-style.scss';

#my_container {
    min-height: 100vh;

    svg {
        width: 5rem;
        height: 5rem;
        fill: #fff;
    }
}
</style>
