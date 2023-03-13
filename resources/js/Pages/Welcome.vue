<script>
import { Head } from '@inertiajs/vue3';
import GuestNavbar from '@/Components/WelcomeHead/Navbar.vue';
import {Link} from '@inertiajs/vue3';

export default{
    components:{
        Head,
        GuestNavbar,
        Link,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        technologies: Array,
        developers: Object,
    },
    data(){
        return{
            form:{
                name: '',
                tech: null,
            }
        }
    },
    methods:{
        goToIndex: function(){
            axios.get('http://localhost:8000/index', this.form)
            .then((res)=>console.log(res));
        }
    }
}
</script>

<template>
    <Head title="Welcome" />
    <GuestNavbar :canLogin="canLogin" :canRegister="canRegister" :laravelVersion="laravelVersion" :phpVersion="phpVersion"/>
        <input type="text" v-model="form.name">
        <select v-model="form.tech">
            <option v-for="tech in technologies" :value="tech.id">{{ tech.name }}</option>
        </select>
        <Link href="/index" method="post" :data="this.form" as="button"> Start searching </Link>            
</template>



