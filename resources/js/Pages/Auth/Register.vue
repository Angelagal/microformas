<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link } from '@inertiajs/vue3';

// 👉 Importar la lógica desde la carpeta Auth/js
import { useRegisterForm } from './js/RegisterForm.js';

const { form, showToast, toastMessage, submit } = useRegisterForm();
</script>

<template>
        <Head title="Registro de Usuario" />
        <!-- Toast de notificación -->
        <transition name="fade">
            <div
                v-if="showToast"
                class="fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white"
                :class="toastMessage.includes('❌') || toastMessage.includes('⚠️') ? 'bg-red-500' : 'bg-green-500'"
            >
                {{ toastMessage }}
            </div>
        </transition>

        <form
            @submit.prevent="submit"
            class="max-w-md mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg border border-orange-500"
        >
            <h2 class="text-center text-3xl font-bold text-orange-600 mb-6">
                Crear cuenta nueva
            </h2>

            <div>
                <InputLabel for="nombre" value="Nombre" />
                <TextInput id="nombre" v-model="form.nombre" type="text" class="mt-1 block w-full" required autofocus />
                <InputError class="mt-2" :message="form.errors.nombre" />
            </div>

            <div class="mt-4">
                <InputLabel for="apellido_paterno" value="Apellido Paterno" />
                <TextInput id="apellido_paterno" v-model="form.apellido_paterno" type="text" class="mt-1 block w-full" required />
                <InputError class="mt-2" :message="form.errors.apellido_paterno" />
            </div>

            <div class="mt-4">
                <InputLabel for="apellido_materno" value="Apellido Materno" />
                <TextInput id="apellido_materno" v-model="form.apellido_materno" type="text" class="mt-1 block w-full" required />
                <InputError class="mt-2" :message="form.errors.apellido_materno" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Correo Electrónico" />
                <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Contraseña" />
                <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirmar Contraseña" />
                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full" required />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="mt-6 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-600 underline hover:text-gray-900"
                >
                    ¿Ya tienes cuenta?
                </Link>

                <PrimaryButton
                    class="ml-4 bg-orange-500 hover:bg-orange-600 text-white"
                    :disabled="form.processing"
                >
                    Registrar
                </PrimaryButton>
            </div>
        </form>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
