<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-light">Profile</h2>
        </template>

        <template #main>
            <div class="py-5">
                <div class="d-flex flex-column gap-5">
                    <div class="container bg-dark text-light">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>

                    <div class="container bg-dark text-light">
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>

                    <div class="container bg-dark text-light">
                        <DeleteUserForm class="max-w-xl" />
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
