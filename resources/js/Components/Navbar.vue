<script>
export default {
    name: "Navbar",
}
</script>

<template>
    <div class="d-flex justify-content-between fixed-top m-3 ">

        <!-- NavBar LEFT-->
        <nav class="left">

            <!-- BDevelopers logo + title -->
            <a class="btn btn-dark shadow-sm shadow-lg" href="/">BDevelopers</a>

        </nav>

        <!-- NavBar RIGHT-->
        <nav class="right">

            <!-- BDevelopers logo + title -->
            <!-- <a class="btn btn-dark shadow-sm shadow-lg mx-3" href="/login">Login</a> -->

            <!-- BDevelopers logo + title -->
            <!-- <a class="btn btn-dark shadow-sm shadow-lg" href="/register">Register</a> -->

            <div class="card text-white bg-dark overflow-hidden">
                <div class="card-header d-flex justify-content-between p-0">
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
                    <img v-if="auth_user" class="card-profile" src="http://placeimg.com/400/400/people" alt="Card image cap">
                    <img v-else class="card-profile" src="../../img/unknown_profile.jpg" alt="">
                </div>
                <ul class="list-group list-group-flush volatile">
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
.left a {
    outline: solid 1px #cf815b;
    outline-offset: 2px;
}

.right .card {
    outline: solid 1px #cf815b;
    outline-offset: 2px;

    width: 100%;
    height: 100%;
    transition: all 5s ease;

    &:not(:hover) .volatile {
        width: 0;
        height: 0;
        opacity: 0;
    }

    a {
        &:hover {
            background-color: #cf815b !important;

            &:last-child {
                color: #121212 !important;
            }
        }

        &:last-child {
            color: #cf815b !important;
        }
    }

    .card-profile {
        object-fit: cover;
        width: 4rem;
        height: 4rem;
    }

    &:hover {
        display: block;
    }
}
</style>