<script>

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

            // ALL MEASURES ARE IN PIXELS

            // Map coords
            let mapTopRightY = 150;
            let mapTopLeftY = 600;
            let mapWidth = window.innerWidth;

            // Bubble size
            let bRadius = 60; /* about */
            let bMargin = 50;
            let bDistance = (bRadius + bMargin) * 2;

            // Column size
            let cMaxHeight = 100;

            // Spawn logic
            let bPerWidth = Math.floor((mapWidth - bDistance) / bDistance);


            // POSITIONING
            this.bubbles.forEach((bubble, index) => {

                // Check if bubble is inside view
                if (index > bPerWidth) {
                    bubble.style.display = "none";
                    return;

                } else {

                    // Check if bubble is skipped
                    let skipped =
                        index > 1 /* first and second bubbles are granted */
                        && Math.floor( /* remaining are decided by noise */
                            (index <= 3 ? 1.3 : 1) /* 3rd and 4th are slightly weighted for displaying purposes */
                            + hiddenNoise.get(
                                (index + 2) * Math.cos(index + Math.PI),
                                (index + 2) * Math.sin(index + Math.PI)
                            )
                        );

                    if (skipped) {
                        bubble.style.display = "none";
                        return;
                    }

                    bubble.style.display = "block";
                }

                // Set bubble profile radius
                let profile = bubble.querySelector(".card-profile");
                profile.style.width = (bRadius * 2) + 'px';
                profile.style.height = (bRadius * 2) + 'px';

                // X Axis
                bubble.style.right =
                    (
                        bMargin /* start offset */
                        + (index * bDistance) /* global offset */
                        + (
                            localOffsetNoise.get(
                                (index + 2) * Math.cos(index + Math.PI),
                                (index + 2) * Math.sin(index + Math.PI)
                            )
                            * (bMargin * .9)
                        ) /* local offset */
                    ) + "px";

                // Y Axis
                bubble.style.bottom =
                    (
                        (10 + cMaxHeight) /* start offset */
                        + (
                            rangeMap(
                                localOffsetNoise.get(
                                    (index + 2) * Math.sin(index + Math.PI),
                                    (index + 2) * Math.cos(index + Math.PI)
                                ),
                                -1, 1, 0, 1)
                            * rangeMap(index, 0, 13, mapTopRightY, mapTopLeftY)
                        )
                    ) + "px";;

            });
        },
    },
    created() {
        // Slice profile in excess
        // TODO: limit controller at source
        this.profiledDevelopers = this.profiledDevelopers.slice(0, 20);
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

        // 
        var vueInstance = this;
        let shownBubbles = [];
        function carouselBubble() {
            // clear show tags
            vueInstance.bubbles.forEach(b => b.classList.remove("show"));

            // check which bubbles are available
            let availableBubbles;
            do {
                availableBubbles = vueInstance.bubbles.filter(b => b.style.display != "none" && !shownBubbles.includes(b))
                if (!availableBubbles.length) {
                    shownBubbles = shownBubbles.slice(-1);
                }
            } while (!availableBubbles.length)

            let showBubble = availableBubbles[Math.floor(Math.random() * availableBubbles.length)];
            shownBubbles.push(showBubble);

            // queue show toggle
            setTimeout(() => {
                showBubble.classList.add("show");
            }, 700);
        }

        // Start Carousel mechanism
        carouselBubble();
        setInterval(() => {
            carouselBubble();
        }, 8000, 400);
    },
}

// "LIBRARIES"
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

// Range mapper
function rangeMap(number, inMin, inMax, outMin, outMax) {
    return (number - inMin) * (outMax - outMin) / (inMax - inMin) + outMin;
}
</script>

<template>
    <div class="ProfilesBackground fixed-top overflow-hidden">

        <!-- Populate with bubbles -->
        <!-- <div :id="'bubble' + index" v-for="(developer, index) in profiledDevelopers" class="bubble rounded">
                                                                            <img :src="getBubbleImage(index)" class="rounded">
                                                                            <div class="volatile">
                                                                                Ciao
                                                                            </div>
                                                                        </div> -->

        <div :id="'bubble' + index" v-for="(developer, index) in profiledDevelopers"
            class="bubble card text-white bg-dark rounded">

            <!-- Card Header (profile pic + name) -->
            <div class="card-header d-flex justify-content-between p-0">

                <!-- Name/welcome -->
                <div class="card-info volatile">
                    <div class="m-3">
                        {{ developer.user.name + " " + developer.user.last }}
                    </div>
                </div>

                <!-- Profile pic -->
                <img :src="getBubbleImage(index)" class="card-profile rounded">

            </div>

            <!-- Card 'body' (navigation links) -->
            <ul class="list-group list-group-flush volatile overflow-hidden">
                <!-- <a class="list-group-item px-3 bg-dark text-white" href="">
                                                        Connect
                                                    </a> -->
                <a class="list-group-item px-3 bg-dark text-white" href="">
                    Connect
                </a>
            </ul>
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
    // background-size: cover;

    // Size
    height: 100vh;
    width: 100vw;

    // Each profile circle
    .bubble {

        // Position
        position: absolute;

        // Sizing and style
        outline: solid 4px #cf815b;
        outline-offset: 2px;

        // Card profile picture
        .card-profile {
            position: relative;
            object-fit: cover;
            /* width: 4rem;
            height: 4rem; */
        }

        .volatile {
            position: relative;
            z-index: 50;
            width: 0;
            height: 0;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: clip;
            opacity: 0;
            transition: all .3s ease;
        }

        &:hover,
        &.show {

            z-index: 40;
            width: auto !important;
            box-shadow: 0 0 15px 3px snow;

            .volatile {
                width: 100%;
                height: 100%;
                opacity: 1;
            }
        }

        &::after {
            content: '';
            position: absolute;
            z-index: 0;
            bottom: -100px;
            right: 3rem;
            display: block;
            width: 2px;
            height: 97px;
            background-color: #cf815b;
        }

        // Card links
        // used !important to override Bootstrap
        a {
            &:hover {
                background-color: #cf815b !important;

                &:last-child {
                    background-color: #d68c67 !important;
                    // color: #cf815b !important;
                }
            }

            &:last-child {
                background-color: #cf815b !important;
                // color: #cf815b !important;
            }
        }
    }
}
</style>