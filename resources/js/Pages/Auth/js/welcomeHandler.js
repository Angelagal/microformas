import { ref } from 'vue';
import { fetchBitacoras } from './bitacoraService.js';

export function useWelcome(user) {
    const showWelcome = ref(true);
    const bitacoras = ref([]);

    const init = async () => {
        setTimeout(async () => {
            showWelcome.value = false;
            bitacoras.value = await fetchBitacoras(user.value.id);
        }, 10000); // 10 segundos
    };

    return { showWelcome, bitacoras, init };
}
