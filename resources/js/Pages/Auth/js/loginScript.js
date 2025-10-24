import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import Swal from 'sweetalert2';

export function useLogin() {
    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = async () => {
        await form.post(route('login'), {
            onSuccess: async () => {
                try {
                    await axios.post(route('bitacora.store'));
                } catch (err) {
                    console.error('Error al registrar bitácora:', err);
                }
                window.location.href = route('welcome');
            },
            onError: () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Correo o contraseña incorrectos',
                });
            },
            onFinish: () => {
                form.reset('password');
            },
        });
    };

    return { form, submit };
}