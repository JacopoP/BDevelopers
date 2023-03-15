<script>
export default{
    name: "Navbar",
}
</script>

<template>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">

            <!-- BDevelopers logo + title -->
            <a class="navbar-brand" href="#">BDevelopers</a>

            <!-- Nav -->
            <div id="navbarNav">
                <ul class="navbar-nav ml-auto list-unstyled d-flex flex-row gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>