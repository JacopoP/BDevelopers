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
                        <a class="list-group-item px-3 bg-dark text-white" href="">
                            Profile Info
                        </a>
                        <a class="list-group-item px-3 bg-dark text-white" href="">
                            Account Settings
                        </a>
                        <a class="list-group-item px-3 bg-dark text-white" href="">
                            Logout
                        </a>
                    </template>

                    <!-- guest links -->
                    <template v-else>
                        <a class="list-group-item px-3 bg-dark text-white" href="">
                            Login
                        </a>
                        <a class="list-group-item px-3 bg-dark text-white" href="">
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
.left>*,
.right>* {
    outline: solid 2px #E8763D;
    outline-offset: 2px;
}

img {
    object-fit: cover;
    width: 4rem;
    height: 4rem;
}

// Right card style
.right .card {

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
        &:hover {
            background-color: #E8763D !important;

            &:last-child {
                color: #121212 !important;
            }
        }

        &:last-child {
            color: #E8763D !important;
        }
    }
}
</style>