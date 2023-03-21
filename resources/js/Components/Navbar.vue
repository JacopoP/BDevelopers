<script>
export default {
    name: "Navbar",
    props: {
        // If user is logged, 
        // an Auth::user will be passaed to the prop below
        auth_user: Object,
    }
}
</script>

<template>
    <div class="d-flex justify-content-between fixed-top m-3 ">

        <!-- NavBar LEFT-->
        <nav class="left rounded ">

            <!-- BDevelopers logo + title -->
            <!-- <a class="btn btn-dark shadow-sm shadow-lg" href="/">BDevelopers</a> -->
            <img class="rounded" src="../../img/logo.png" alt="">

        </nav>

        <!-- NavBar RIGHT-->
        <nav class="right">

            <div class="card text-white bg-dark overflow-hidden">

                <!-- Card Header (profile pic + name) -->
                <div class="card-header d-flex justify-content-between p-0">

                    <!-- Name/welcome -->
                    <div class="card-info volatile">
                        <div class="m-3">
                            <template v-if="auth_user">
                                {{ auth_user.name }}
                            </template>
                            <template v-else>
                                Welcome!
                            </template>
                        </div>
                    </div>

                    <!-- Profile pic -->
                    <img v-if="auth_user" class="card-profile" src="http://placeimg.com/400/400/people"
                        alt="Card image cap">
                    <img v-else class="card-profile" src="../../img/unknown_profile.jpg" alt="">

                </div>

                <!-- Card 'body' (navigation links) -->
                <ul class="list-group list-group-flush volatile overflow-hidden">

                    <!-- authenticated user links -->
                    <template v-if="auth_user">
                        <a class="list-group-item px-3 text-white" href="">
                            Profile Info
                        </a>
                        <a class="list-group-item px-3 text-white" href="">
                            Account Settings
                        </a>
                        <a class="list-group-item px-3 text-white" href="">
                            Logout
                        </a>
                    </template>

                    <!-- guest links -->
                    <template v-else>
                        <a class="list-group-item px-3 text-white" href="/login">
                            Login
                        </a>
                        <a class="list-group-item px-3 text-white" href="/register">
                            Register
                        </a>
                    </template>

                </ul>
            </div>
        </nav>

    </div>
</template>

<style lang="scss" scoped>
// Accent outline for main navbar elements
@import '../../sass/variable.scss';

.left>*,
.right>* {
    outline: solid 3px $brand_fourth;
    outline-offset: 2px;
    // box-shadow: 0 0 15px 3px inset snow;
    backdrop-filter: blur(2px);
}

img {
    object-fit: cover;
    width: 4rem;
    height: 4rem;
}

// Right card style
.right .card {

    background-color: #2024287f !important;

    .volatile {
        width: 0;
        height: 0;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: clip;
        opacity: 0;
        transition: all .3s ease;
    }

    &:hover .volatile {
        width: 100%;
        height: 100%;
        opacity: 1;
    }

    /* &:not(:hover) .volatile {
        width: 0;
        height: 0;
        opacity: 0;
    } */

    // Card profile picture
    .card-profile {
        position: relative;
    }

    // Card links
    // used !important to override Bootstrap
    a {
        background-color: #00000000 !important;

        &:hover {
            // background-color: $brand_fourth !important;
            background-image: linear-gradient(315deg,
                    hsl(219deg 40% 25%) 0%,
                    hsl(233deg 29% 32%) 11%,
                    hsl(256deg 27% 37%) 22%,
                    hsl(278deg 28% 39%) 33%,
                    hsl(301deg 29% 41%) 44%,
                    hsl(319deg 36% 47%) 56%,
                    hsl(331deg 46% 53%) 67%,
                    hsl(340deg 63% 59%) 78%,
                    hsl(349deg 81% 64%) 89%,
                    hsl(360deg 100% 70%) 100%);

            &:last-child {
                color: snow !important;
            }
        }

        &:last-child {
            color: $brand_fourth !important;
        }
    }
}
</style>