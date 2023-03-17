<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
const form = useForm({
    payment_method_nonce: undefined,
    amount: 0,
});
let doPayment = function(){};
function paymentCheck(){
    if(form.amount){
        doPayment();
    }
}
const props = defineProps(['token', 'sponsors']);
onMounted(()=>{
    braintree.dropin.create({
            authorization: props.token,
            selector: '#dropin-container'
        }, (err, dropinInstance) => {
            if (err) console.error(err);
            doPayment = function(){
                dropinInstance.requestPaymentMethod((error, payload) => {
                    if (error) console.error(error);
                    form.payment_method_nonce = payload.nonce;
                    form.post(route('payment'));
                });
            }
        });
})
</script>

<script>
export default{
    data(){
        return{
            isProcessing: false,
            clicked: false,
        }
    },
}
</script>

<template>
    <GuestLayout class="bg-dark text-light overflow-hidden">
        <form id="payment-form" method="post" @submit.prevent="()=>{paymentCheck(); isProcessing=true}">
            <div id="dropin-container"></div>
            <div class="d-flex justify-content-between gap-3 mt-4">
                <div :class="'card bg-dark border-light text-center' + [form.amount == sponsor.price ? '' : ' opacity-50']" v-for="sponsor in sponsors" @click="()=>{form.amount = sponsor.price}">
                    <div class="card-body">
                        <h5 class="card-title">{{ sponsor.plan_name }}</h5>
                        <p class="card-text">
                            Sponsor duration: {{ sponsor.length }} hours <br>
                            Price: &euro; {{ sponsor.price }}
                        </p>
                    </div>
                </div>
            </div>
            <input class="btn btn-light mt-4 mx-auto d-block" type="submit" value="Pay and get sponsored" @click="this.clicked=true" :disabled="isProcessing"/>
            <p v-show="form.amount == 0 && this.clicked" class="text-center text-danger mt-3">Please, select a plan before checking out</p>
        </form>
    </GuestLayout>
</template>

<style lang="scss" scoped>
.card{
    cursor: pointer;
    transition: transform .2s;
    &:hover{
        transform: scale(1.1);
    }
}
</style>