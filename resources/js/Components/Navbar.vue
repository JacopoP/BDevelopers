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
            <a class="btn btn-dark shadow-sm shadow-lg" href="/login">Login</a>
        </nav>

    </div>
</template>

<!-- Nav -->
<!-- <div id="navbarNav">
    <ul class="navbar-nav ml-auto list-unstyled d-flex flex-row gap-2">
        <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/register">Register</a>
        </li>
    </ul>
</div> -->