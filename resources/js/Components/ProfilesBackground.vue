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

        // Dynamic image retrieval
        getBubbleImage(index) {
            let n = index + 1;
            return new URL(
                '../../../../public/storage/uploads/profile_photo/profile' + n + '.png',
                import.meta.url)
                .href;
        },

        // Set bubbles position on screen
        positionBubbles() {

            // Bubble size
            let bRadius = 60; /* about */
            let bMargin = 50;
            let bDistance = (bRadius + bMargin) * 2;
            let bLocalOffsetAllowance = bMargin * .95;
            let bLocalYOffsetAllowance = window.innerHeight / 2;
            let maxPop = -.02;
            let minPop = -.001;

            // Screen sizes
            let mapOverflowXMargin = bRadius;
            let mapOverflowYMargin = 100;
            let mapWidth = window.innerWidth - (mapOverflowXMargin * 2);
            let mapHeight = window.innerHeight - (mapOverflowYMargin * 2);
            let maxWidth = 3000;
            let minWidth = 1;

            // So...
            let bPerWidth = Math.floor((mapWidth - (bDistance / 2)) / bDistance);

            this.bubbles.forEach((bubble, index) => {

                // Check if bubble is inside view
                if (index > bPerWidth) {
                    bubble.style.display = "none";
                    return;
                } else {
                    bubble.style.display = "block";
                }

                // Check for bubble visibility
                /* let visible = Boolean(Math.ceil(
                    (
                        hiddenNoise.get(index % bPerWidth, index / bPerWidth)
                        // + .01
                        + (mapWidth - minWidth) * (maxPop - minPop) / (maxWidth - minWidth) + minPop
                    )
                ));
                bubble.style.display = visible ? 'block' : 'none'; */

                // Set bubble radiu
                bubble.style.width = (bRadius * 2) + 'px';
                bubble.style.height = (bRadius * 2) + 'px';

                // X Axis
                bubble.style.right =
                    (
                        mapOverflowXMargin /* off-screen start */
                        + (index * bDistance) /* global offset */
                        // + (localOffsetNoise.get(index % bPerWidth, index / bPerWidth) * bLocalOffsetAllowance) /* local offset */
                    ) + "px";

                // Y Axis
                bubble.style.top =
                    (
                        (mapOverflowYMargin + (mapHeight / 2)) /* off-screen start */
                        // + (parseInt(index / bPerWidth) * bDistance) /* global offset */
                        + localOffsetNoise.get(index, Math.PI) * bLocalYOffsetAllowance /* local offset */
                    ) + "px";;

            });
        },
    },
    created() {
        // Slice profile in excess
        // TODO: limit controller at source
        this.profiledDevelopers = this.profiledDevelopers.slice(0, 15);
    },
    mounted() {

        // Refer bubbles
        this.profiledDevelopers.forEach((dev, index) => {
            // Refer to DOM element
            let bubble = document.getElementById('bubble' + index);

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
        <div :id="'bubble' + index" v-for="(developer, index) in profiledDevelopers" class="bubble rounded">
            <img :src="getBubbleImage(index)" class="rounded">
            <div class="volatile">
                <!-- Ciao -->
            </div>
        </div>

    </div>
</template>

<style lang="scss" scoped>
.ProfilesBackground {

    // Background
    background-color: #121212;
    background-image: url('../../img/background_earth.jpg');
    background-position: bottom right;
    background-repeat: no-repeat;
    background-size: cover;

    // Size
    height: 100vh;
    width: 100vw;

    // Each profile circle
    .bubble {

        // Position
        position: absolute;

        // Sizing and style
        // box-shadow: 3px 5px black;
        // filter: drop-shadow(0 0 0.75rem #cf815b);
        outline: solid 4px #cf815b;
        outline-offset: 2px;

        &:hover {
            opacity: .5;
        }

        .volatile {}

        img {
            object-fit: cover;
        }

        &::after {
            content: '';
            position: absolute;
            bottom: -250px;
            left: 3rem;
            display: block;
            width: 2px;
            height: 248px;
            background-color: #cf815b;
        }
    }
}
</style>