import axios from 'axios';

export async function fetchBitacoras(userId) {
    try {
        const response = await axios.get(`/api/bitacora_acceso/usuario/${userId}`);
        return response.data.map(b => ({
            fecha_acceso: b.fecha_acceso,
            fecha_salida: b.fecha_salida || ''
        }));
    } catch (error) {
        console.error('Error al obtener bitácoras:', error);
        return [];
    }
}
