<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import { useLogin } from './js/loginScript.js'; 

const { form, submit } = useLogin();
</script>

<template>
    <Head title="Login" />

    <div class="flex justify-center items-start min-h-[85vh] bg-gray-100 pt-16">
      <form
        @submit.prevent="submit"
        class="w-full max-w-[1000px] p-8 bg-white rounded-2xl shadow-2xl
                 border-t-4 border-orange-500 transform transition duration-300 hover:scale-[1.02]"
        >
        <div class="flex flex-col items-center mb-8">
          <h2 class="text-3xl font-extrabold text-orange-600 tracking-wide">Iniciar Sesión</h2>
        </div>

        <div class="relative mb-5">
          <svg
            class="w-5 h-5 text-orange-500 absolute left-3 top-3.5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 12H4m12 0l-4 4m4-4l-4-4m3-4h3a2 2 0 012 2v12a2 2 0 01-2 2h-3" />
          </svg>
          <TextInput
            v-model="form.email"
            type="email"
            placeholder="Correo electrónico"
            class="w-full pl-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition bg-gray-50"
            required
          />
        </div>

        <div class="relative mb-6">
          <svg
            class="w-5 h-5 text-orange-500 absolute left-3 top-3.5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 15v2m-6-4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2z" />
          </svg>
          <TextInput
            v-model="form.password"
            type="password"
            placeholder="Contraseña"
            class="w-full pl-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition bg-gray-50"
            required
          />
        </div>

        <PrimaryButton
          class="w-full py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-semibold shadow-md transition duration-200"
          :disabled="form.processing"
        >
          Iniciar Sesión
        </PrimaryButton>

        <div class="text-center text-sm text-gray-500 mt-5 space-y-2">
          <p>
            ¿No tienes cuenta?
            <a
              href="http://127.0.0.1:8000/register"
              target="_blank"
              rel="noopener noreferrer"
              class="text-orange-500 hover:underline font-semibold"
            >
              Registrarse
            </a>
          </p>
        </div>
      </form>
    </div>
</template>
