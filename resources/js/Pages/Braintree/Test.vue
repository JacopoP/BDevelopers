<script setup>
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
    const form = useForm({
        payment_method_nonce: undefined,
    });
let prova = function(){};
const props = defineProps(['token']);
onMounted(()=>{
    braintree.dropin.create({
            authorization: props.token,
        selector: '#dropin-container'
        }, (err, dropinInstance) => {
            if (err) console.error(err);
            prova = function(){
                dropinInstance.requestPaymentMethod((error, payload) => {
                    if (error) console.error(error);
                    form.payment_method_nonce = payload.nonce;
                    form.post(route('payment'));
                });
            }
        });
})
</script>

<template>
    <form id="payment-form" method="post" @submit.prevent="prova">
        <div id="dropin-container"></div>
        <input type="submit" />
    </form>
</template>

<style lang="scss" scoped>

</style>