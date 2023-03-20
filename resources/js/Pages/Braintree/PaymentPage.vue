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
            clicked: false,
            amountSelected: false,
            checkout: false,
            checkoutToClick: true,
        }
    },
}
</script>

<template>
    <GuestLayout class="bg-dark text-light overflow-hidden">
        <div>
            <form id="payment-form" method="post" @submit.prevent="()=>{paymentCheck()}">
                <div class="d-flex justify-content-between gap-3 mt-4">
                    <div :class="'card bg-dark border-light text-center' + [form.amount == sponsor.price ? '' : ' opacity-50']" v-for="sponsor in sponsors" @click="()=>{form.amount = sponsor.price; this.amountSelected=true}">
                        <div class="card-body">
                            <h5 class="card-title">{{ sponsor.plan_name }}</h5>
                            <p class="card-text">
                                Sponsor duration: {{ sponsor.length }} hours <br>
                                Price: &euro; {{ sponsor.price }}
                            </p>
                        </div>
                    </div>
                </div>
                <button v-if="this.amountSelected && this.checkoutToClick" class="btn btn-light mt-4 mx-auto d-block" @click="this.checkout=true; this.amountSelected=false; this.checkoutToClick=false">Checkout</button>
                <div v-show="this.checkout" id="dropin-container"></div>
                <input v-if="this.checkout" class="btn btn-light mt-4 mx-auto d-block" type="submit" value="Pay and get sponsored" @click="this.clicked=true"/>
                <p v-show="form.amount == 0 && this.clicked" class="text-center text-danger mt-3">Please, select a plan before checking out</p>
            </form>
        </div>
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