<script setup>
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
    const form = useForm({
        payment_method_nonce: undefined,
        amount: 0,
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
        <input type="radio" value="2.99" v-model="form.amount" id="plan1">
        <label for="plan1">Base</label>
        <br>
        <input type="radio" value="5.99" v-model="form.amount" id="plan2">
        <label for="plan2">Intermediate</label>
        <br>
        <input type="radio" value="9.99" v-model="form.amount" id="plan3">
        <label for="plan2">Advanced</label>
        <br>
        <input type="submit" />
    </form>
</template>

<style lang="scss" scoped>

</style>