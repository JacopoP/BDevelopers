<template>
    <div class=" _myClass  pt-3">
        <div class="container">
            <div class="d-flex flex-column flex-lg-row justify-content-between">

                <div class=" d-flex flex-column align-items-center pb-3 _width _breakpoints">
                    <h3 class="text-light pb-2">BDeveloper</h3>
                    <span class="text-light text-center">Here you can find your Web Developer, create your project
                        now!</span>
                </div>

                <div class="d-flex flex-column pb-3 align-items-center _width _breakpoints">
                    <h3 class="text-light pb-2">Authors</h3>
                    <div class="d-flex flex-column">
                        <a class="text-light" href="https://github.com/VolxDarkTV"><i class="fa-brands fa-github pe-1"></i>Vincenzo</a>
                        <a class="text-light" href="https://github.com/FrancescoLimpias"><i class="fa-brands fa-github pe-1"></i>Francesco</a>
                        <a class="text-light" href="https://github.com/edaless"><i class="fa-brands fa-github pe-1"></i>Emanuele</a>
                        <a class="text-light" href="https://github.com/JacopoP"><i class="fa-brands fa-github pe-1"></i>Jacopo</a>
                        <a class="text-light" href="https://github.com/Emanuela91"><i class="fa-brands fa-github pe-1"></i>Emanuela</a>
                    </div>
                </div>

                <div class="d-flex flex-column pb-3 align-items-center _width _breakpoints">
                    <h3 class="text-light pb-2">Contacts</h3>
                    <div class="d-flex flex-column">
                        <span class="text-light"><i class="fa-solid fa-phone pe-1"></i>(541) 183-4040</span>
                        <a class="text-light" href="#"><i class="fa-solid fa-envelope pe-1"></i>info@webdev.com</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center text-light text-center pt-5 pb-3" style="font-size: 10px; opacity: 0.6;">
                Copyright<i class="fa-regular fa-copyright pe-1"></i> Web BDevelopers - Milan (IT), 2023 -
                All Rights
                Reserved</div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use 'resources/sass/variable.scss' as *;

a{
    text-decoration: none;
}
._myClass {
    background-color: $brand_fourth;
}

._width {
    width: calc(100% / 3);
}

@media screen and (max-width: 992px) {
    ._breakpoints {
        width: 100%;
    }
}
</style>