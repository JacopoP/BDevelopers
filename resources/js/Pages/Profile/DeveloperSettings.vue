<script>
    // @vite('resources/js/app.js');

</script>

<template>

    <form class="d-flex flex-column" method="post" action="{{ route('profile.dev.create') }}">

        <input type="text" name="address" placeholder="Name" value="">
        <input type="text" name="phone_number" placeholder="PhoneNumber">
        <input type="file" name="profile_path" placeholder="Profile Image">
        <input type="file" name="cv_path">
        <input type="text" name="portfolio_url" placeholder="portfolio URL">
        <textarea name="about_me" cols="30" rows="3" placeholder="Write about you"></textarea>
        <textarea name="performances" cols="30" rows="3" placeholder="Write here the jobs you offer"></textarea>

        <input class="btn" type="submit" value="SEND">
    </form>

</template>

<style lang="scss">
@use 'resources/sass/general.scss' as *;
.test{
    color: $brand_primary;
}
</style>