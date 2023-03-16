<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
const props = defineProps(['result', 'developer']);
console.log(props.result);
console.log(props.developer);
</script>

<template>
    <GuestLayout>
        <div class="my_container bg-dark">
            <template v-if="result.success">
                <h1>Congratulation!</h1>
            </template>
        </div>
    </GuestLayout>
</template>