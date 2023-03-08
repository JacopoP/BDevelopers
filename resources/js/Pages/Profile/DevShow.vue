<script setup>
import { ref } from 'vue';




// Head
import { Head } from '@inertiajs/vue3';




const props = defineProps({
    dato: Array,
});
// console.log(props);


// console.log(form);
</script>
    
<template>
    <div>{{ $page.props.dato }}</div>
</template>

<style lang="scss">
@use 'resources/sass/general.scss' as *;

.test {
    color: $brand_primary;
}

.my_input {
    border-radius: 30px;
    padding: 10px 20px;
}
</style>