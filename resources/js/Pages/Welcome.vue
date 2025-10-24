<script setup>
import { onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

import { useUserData } from './Auth/js/userData.js';
import { useWelcome } from './Auth/js/welcomeHandler.js';

const { user } = useUserData();
const { showWelcome, bitacoras, init } = useWelcome(user);

onMounted(() => {
	init();
});
</script>

<template>
	<Head title="Dashboard" />

	<AuthenticatedLayout>
			<div class="mx-auto max-w-7xl sm:px-6 lg:px-8 border-2 border-gray-300 rounded-xl">
				<div class="overflow-hidden bg-white shadow-xl sm:rounded-xl">
					<div class="p-6 text-gray-900">

						<!-- Mensaje de bienvenida -->
						<div v-if="showWelcome" class="mb-8 p-4 bg-green-100 text-green-800 rounded-lg shadow-inner">
							¡Bienvenido {{ user.nombre }} {{ user.apellido_paterno }} {{ user.apellido_materno }}!<br>
							<small class="text-green-700">{{ user.email }}</small>
						</div>

						<!-- Tabla de bitácoras -->
						<div v-else>
							<!-- TÍTULO -->
							<h3 class="font-bold text-2xl text-black-900">Bitácoras de acceso</h3>

							<!-- LÍNEA 1: Negra, Ancho Completo -->
							<div class="w-full h-5 bg-black mt-2"></div>

							<!-- LÍNEA 2: Naranja, Ancho Reducido -->
							<div class="w-full h-5 bg-orange-500 mb-4"></div>

							<!-- Contenedor principal de la tabla: Sombra y redondeado -->
							<div class="overflow-hidden rounded-xl shadow-lg border border-gray-100">
								<table class="w-full text-left text-sm text-gray-600">
									
									<!-- Encabezado (Thead) con fondo más notorio -->
									<thead 
										class="text-xs uppercase text-gray-800 border-b border-gray-300" 
										style="background-color: #FEE7D7;" 
										>
										<tr>
											<!-- Clase px-6 py-4 para más espacio -->
											<th scope="col" class="px-6 py-4 font-extrabold tracking-wider text-black text-base">Fecha de acceso</th>
											<th scope="col" class="px-6 py-4 font-extrabold tracking-wider text-black text-base">Fecha de salida</th>
										</tr>
									</thead>
									
									<!-- Cuerpo (Tbody) -->
									<tbody>
										<tr 
											v-for="(b, index) in bitacoras" 
											:key="index"
											class="border-b border-gray-100 even:bg-gray-200 hover:bg-orange-100 transition duration-150"
											>
											<!-- CLAVE: Se cambió 'odd:bg-gray-50' por 'even:bg-gray-200' para mayor contraste. -->
											
											<td class="px-6 py-3 font-medium text-gray-800 whitespace-nowrap">
												{{ b.fecha_acceso }}
											</td>
											<td class="px-6 py-3 font-normal text-gray-600">
												{{ b.fecha_salida }}
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
	</AuthenticatedLayout>
</template>