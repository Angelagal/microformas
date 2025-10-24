import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

export function useUserData() {
    const { auth } = usePage().props;

    const user = ref({
        id: auth.user.id,
        nombre: auth.user.nombre,
        apellido_paterno: auth.user.apellido_paterno,
        apellido_materno: auth.user.apellido_materno,
        email: auth.user.email,
    });

    return { user };
}
