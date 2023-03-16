<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-secondary">Delete Account</h2>

            <p class="mt-1 fs-6 text-secondary">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                your account, please download any data or information that you wish to retain.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Delete Account</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="container bg-dark text-light py-4">
                <h2 class="text-danger fs-3 textsecondary">
                    Are you sure you want to delete your account?
                </h2>

                <p class="fs-6 text-secondary">
                    Once your account is deleted, all of its resources and data will be <span class="text-danger">permanently deleted</span>. Please
                    enter your password to confirm you would like to permanently <span class="text-danger">delete your account</span>.
                </p>

                <div class="d-flex flex-column gap-3">

                    <div class="my_text_input_label">
                        <InputLabel class="my_input_label bg-dark" for="password" value="Password"/>

                        <TextInput
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            placeholder="Password"
                            @keyup.enter="deleteUser"
                        />

                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-between">
                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                        <DangerButton
                            :class="{ 'shadow': form.processing }"
                            :disabled="form.processing"
                            @click="deleteUser"
                        >
                            Delete Account
                        </DangerButton>
                    </div>

                </div>
            </div>
        </Modal>
    </section>
</template>
