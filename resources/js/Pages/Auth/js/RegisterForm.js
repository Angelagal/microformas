import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export function useRegisterForm() {
    const showToast = ref(false);
    const toastMessage = ref('');

    const form = useForm({
        nombre: '',
        apellido_paterno: '',
        apellido_materno: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        const passwordRegex = /^(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
        if (!passwordRegex.test(form.password)) {
            showNotification('⚠️ La contraseña debe tener mínimo 8 caracteres, 1 letra mayúscula y 1 carácter especial', 'error');
            return;
        }

        form.post(route('register'), {
            onSuccess: () => {
                form.reset('password', 'password_confirmation');
                showNotification('✅ Registro exitoso. Redirigiendo al login...', 'success');
                setTimeout(() => {
                    window.location.href = route('login');
                }, 2000);
            },
            onError: () => {
                showNotification('❌ Error al registrar. Verifica los datos.', 'error');
            },
        });
    };

    const showNotification = (message) => {
        toastMessage.value = message;
        showToast.value = true;
        setTimeout(() => {
            showToast.value = false;
        }, 3000);
    };

    return {
        form,
        showToast,
        toastMessage,
        submit
    };
}
