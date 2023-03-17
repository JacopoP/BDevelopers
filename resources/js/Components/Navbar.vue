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
                    <div class="card-info m-3 volatile">
                        Username
                    </div>
                    <img class="card-profile" src="http://placeimg.com/400/400/people" alt="Card image cap">
                </div>
                <ul class="list-group list-group-flush volatile">
                    <a class="list-group-item px-3 bg-dark text-white" href="">
                        Profile Info
                    </a>
                    <a class="list-group-item px-3 bg-dark text-white" href="">
                        Account Settings
                    </a>
                    <a class="list-group-item px-3 bg-dark text-white" href="">
                        Logout
                    </a>
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
    // display: none;
    outline: solid 1px #cf815b;
    outline-offset: 2px;

    &:not(:hover) .volatile {
        display: none;
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
        width: 4rem;
        height: 4rem;
    }

    &:hover {
        display: block;
    }
}
</style>