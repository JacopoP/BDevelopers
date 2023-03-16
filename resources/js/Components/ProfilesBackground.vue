<script>
export default {
    name: 'ProfilesBackground',
    props: {
        developers: Array
    },
    data() {
        return {
            profiledDevelopers: this.developers.filter(dev => dev.profile_path),
        };
    },
    methods: {
        populate() {
            // Screen size
            let winWidth = window.innerWidth;
            let winHeight = window.innerHeight;

            // Bubble size
            let bRadius = 50; /* about */
            let bMargin = 5;

            // So...
            let bPerWidth = Math.floor(winWidth / (bRadius + bMargin));

            this.profiledDevelopers.forEach((dev, index) => {
                let bubble = document.getElementById('img' + index);

                // X Axis
                bubble.style.left = (/* offset */(bPerWidth % index) * /* distance */(bRadius + bMargin)) /* + Math.random() * 1000 */ + "px";

                console.log(bPerWidth);
                console.log(bPerWidth % index);

                // Y Axis
                bubble.style.top = /* (index * this.radius) */ /* Math.random() * 500 */ + "0 px";

            });
        },
    },
    mounted() {
        this.populate();
    },
}
</script>

<template>
    <div class="ProfilesBackground fixed-top">
        <template v-for="(developer, index) in profiledDevelopers">
            <img :id="'img' + index" :src="developer.profile_path" class="bubble">
        </template>
    </div>
</template>

<style lang="scss">
.ProfilesBackground {
    background-color: snow;
    height: 100vh;
    width: 100vw;

    // Each profile circle
    .bubble {

        // Position
        position: absolute;

        // Sizing and style
        width: 3rem;
        height: 3rem;
        object-fit: cover;
        border-radius: 50%;

    }
}
</style>