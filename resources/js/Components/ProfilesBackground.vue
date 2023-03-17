<script>
// Perlin noise generator
function generatePNoise() {
    return {
        rand_vect: function () {
            let theta = Math.random() * 2 * Math.PI;
            return { x: Math.cos(theta), y: Math.sin(theta) };
        },
        dot_prod_grid: function (x, y, vx, vy) {
            let g_vect;
            let d_vect = { x: x - vx, y: y - vy };
            if (this.gradients[[vx, vy]]) {
                g_vect = this.gradients[[vx, vy]];
            } else {
                g_vect = this.rand_vect();
                this.gradients[[vx, vy]] = g_vect;
            }
            return d_vect.x * g_vect.x + d_vect.y * g_vect.y;
        },
        smootherstep: function (x) {
            return 6 * x ** 5 - 15 * x ** 4 + 10 * x ** 3;
        },
        interp: function (x, a, b) {
            return a + this.smootherstep(x) * (b - a);
        },
        seed: function () {
            this.gradients = {};
            this.memory = {};
        },
        get: function (x, y) {
            if (this.memory.hasOwnProperty([x, y]))
                return this.memory[[x, y]];
            let xf = Math.floor(x);
            let yf = Math.floor(y);
            //interpolate
            let tl = this.dot_prod_grid(x, y, xf, yf);
            let tr = this.dot_prod_grid(x, y, xf + 1, yf);
            let bl = this.dot_prod_grid(x, y, xf, yf + 1);
            let br = this.dot_prod_grid(x, y, xf + 1, yf + 1);
            let xt = this.interp(x - xf, tl, tr);
            let xb = this.interp(x - xf, bl, br);
            let v = this.interp(y - yf, xt, xb);
            this.memory[[x, y]] = v;
            return v;
        }
    };
}

let localOffsetNoise = generatePNoise();
localOffsetNoise.seed();

let hiddenNoise = generatePNoise();
hiddenNoise.seed();

export default {
    name: 'ProfilesBackground',
    props: {
        developers: Array
    },
    data() {
        return {
            profiledDevelopers: this.developers.filter(dev => dev.profile_path),
            bubbles: [],
        };
    },
    methods: {
        getBubbleImage(index) {
            let n = index + 1;
            return new URL(
                '../../../../public/storage/uploads/profile_photo/profile' + n + '.png',
                import.meta.url)
                .href;
        },

        positionBubbles() {

            // Bubble size
            let bRadius = 60; /* about */
            let bMargin = 50;
            let bDistance = (bRadius + bMargin) * 2;
            let bLocalOffsetAllowance = bMargin * .95;
            let maxPop = -.02;
            let minPop = -.001;

            // Screen sizes
            let mapOverflowXMargin = 25;
            let mapOverflowYMargin = 100;
            let mapWidth = window.innerWidth - (mapOverflowXMargin * 2);
            let mapHeight = window.innerHeight - (mapOverflowYMargin * 2);
            let maxWidth = 3000;
            let minWidth = 1;

            // So...
            let bPerWidth = Math.floor(mapWidth / bDistance);
            let bPerHeight = Math.floor(mapHeight / bDistance);

            this.bubbles.forEach((bubble, index) => {

                // Check for bubble visibility
                let visible = Boolean(Math.ceil(
                    (
                        hiddenNoise.get(index % bPerWidth, index / bPerWidth)
                        // + .01
                        + (mapWidth - minWidth) * (maxPop - minPop) / (maxWidth - minWidth) + minPop
                    )
                ));
                /* if(!visible){
                    return;
                } */
                console.log(visible);
                bubble.style.display = visible ? 'block' : 'none';

                // TMP
                bubble.style.zIndex = 500;

                // Set bubble radiu
                bubble.style.width = (bRadius * 2) + 'px';
                bubble.style.height = (bRadius * 2) + 'px';

                // X Axis
                bubble.style.left =
                    (
                        (mapOverflowXMargin * .2) /* off-screen start */
                        + ((index % bPerWidth) * bDistance) /* global offset */
                        + (localOffsetNoise.get(index % bPerWidth, index / bPerWidth) * bLocalOffsetAllowance) /* local offset */
                    ) + "px";

                // Y Axis
                bubble.style.top =
                    (
                        (mapOverflowYMargin) /* off-screen start */
                        + (parseInt(index / bPerWidth) * bDistance) /* global offset */
                        + localOffsetNoise.get(index % bPerWidth, index / bPerWidth) * bLocalOffsetAllowance /* local offset */
                    ) + "px";;

            });
        },
    },
    mounted() {

        // Refer bubbles
        this.profiledDevelopers.forEach((dev, index) => {
            // Refer to DOM element
            let bubble = document.getElementById('img' + index);

            // Add to bubbles array
            this.bubbles.push(
                bubble
            );
        });

        // Give a first position to bubbles
        this.positionBubbles();

        // Listen for window resizes
        window.addEventListener('resize', this.positionBubbles);
    },
}
</script>

<template>
    <div class="ProfilesBackground fixed-top overflow-hidden">

        <!-- Populate with bubbles -->
        <template v-for="(developer, index) in profiledDevelopers">
            <!-- <img :id="'img' + index" :src="developer.profile_path" class="bubble"> -->
            <img :id="'img' + index" :src="getBubbleImage(index)" class="bubble">
        </template>

    </div>
</template>

<style lang="scss">
.ProfilesBackground {
    background-color: #121212;
    background-image: url(../../img/background.svg);
    background-position: center;
    height: 100vh;
    width: 100vw;

    // Each profile circle
    .bubble {

        // Position
        position: absolute;

        // Sizing and style
        object-fit: cover;
        border-radius: 50%;
        // box-shadow: 3px 5px black;
        // border: .5px solid snow;
        filter: drop-shadow(0 0 0.75rem #cf815b);

    }
}
</style>