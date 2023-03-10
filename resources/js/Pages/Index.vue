<script>
import axios from 'axios';
const apiUrl = 'http://localhost:8000/api/';
const apiVersion = 'v1/';
const api = apiUrl + apiVersion;
export default {
    props: ['technologies'],
    data() {
        return {
            developers: Object,
            nameFilter: '',
            post: {
                nFilter: '',
                lFilter: '',
                ratingFilter: null,
                reviewFilter: null,
                techFilter: [],
            }
        }
    },
    methods: {
        goFilter: function () {
            let textArray = this.nameFilter.split(' ');
            console.log(textArray);
            this.post.nFilter = textArray[0];
            if (textArray.length >= 1) { textArray.shift() };
            this.post.lFilter = textArray.join(' ');
            console.log(this.post);
            axios.post(api + 'search', this.post)
                .then((res) => {
                    this.developers = res.data.response.developers
                })
                .catch((err) => console.log(err));
        }
    },
    mounted() {
        axios.get(api + 'index')
            .then((res) => {
                this.developers = res.data.response.developers
            })
            .catch((err) => console.log(err));
    }
}
</script>

<template>
    <form @submit.prevent="goFilter">
        <h2>Filters</h2>
        <label for="nameFilter">Name</label>
        <input type="text" v-model="this.nameFilter" name="nameFilter" placeholder="name">
        <label for="ratingFilter">Raitings avarage</label>
        <select v-model="this.post.ratingFilter" id="raitingFilter">
            <option :value="null">Reset</option>
            <option value="1">1+</option>
            <option value="2">2+</option>
            <option value="3">3+</option>
            <option value="4">4+</option>
        </select>
        <label for="reviewFilter">Review number</label>
        <select v-model="this.post.reviewFilter" id="raitingFilter">
            <option :value="null">Reset</option>
            <option value="5">5+</option>
            <option value="10">10+</option>
            <option value="50">50+</option>
            <option value="100">100+</option>
        </select>
        <h2>Technology filter</h2>
        <div v-for="technology in this.technologies">
            <input type="checkbox" v-model="this.post.techFilter" :value="technology.id">
            <label for="techFilter[]">{{ technology.name }}</label>
        </div>
        <input type="submit" value="Filter">
    </form>
    <br>
    <ul>
        <li v-for="developer in this.developers">
            {{ developer.user.name }} {{ developer.user.last }} <br>
            {{ developer.user.email }} <br>
            <span v-for="tech in developer.technologies">{{ tech.name }}&nbsp;</span>
            <hr>
        </li>
    </ul>
</template>

<style lang="scss">
ul {
    list-style: none;
}
</style>