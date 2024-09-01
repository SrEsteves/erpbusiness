<template>
    <Layout title="Pedidos">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Lista de Pedidos</h1>

            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white rounded-lg shadow">
                    <thead class="bg-blue-600 text-white uppercase text-sm leading-normal">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Cliente</th>
                            <th class="px-6 py-3 text-left">Total</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        <tr v-for="order in orders" :key="order.id" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-4">{{ order.id }}</td>
                            <td class="px-6 py-4">{{ order.client.name }}</td>
                            <td class="border px-4 py-2">R$ {{ Number(order.total_price).toFixed(2) }}</td>
                            <td class="px-6 py-4">
                                <span :class="statusClass(order.status)">{{ order.status }}</span>
                            </td>
                            <td class="px-6 py-4 flex space-x-4">
                                <a :href="`/orders/${order.id}/edit`" class="text-blue-600 hover:underline">Editar</a>
                                <form :action="`/orders/${order.id}`" method="POST" class="inline-block">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="/orders/create" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                    Criar Novo Pedido
                </a>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { defineProps } from 'vue';
import Layout from '@/Layouts/Layout.vue';

const props = defineProps({
    orders: Array
});

const statusClass = (status) => {
    switch (status) {
        case 'Pendente':
            return 'text-yellow-500 font-semibold';
        case 'Concluído':
            return 'text-green-500 font-semibold';
        case 'Cancelado':
            return 'text-red-500 font-semibold';
        default:
            return 'text-gray-500 font-semibold';
    }
};
</script>
