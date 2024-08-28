<template>
    <Layout title="Lista de Pedidos">
        <div class="mb-4">
            <Link href="/orders/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Adicionar Pedido</Link>
        </div>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Cliente</th>
                    <th class="py-2">Total</th>
                    <th class="py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td class="border px-4 py-2">{{ order.client.name }}</td>
                    <td class="border px-4 py-2">{{ order.total_price }}</td>
                    <td class="border px-4 py-2">
                        <Link :href="`/orders/${order.id}/edit`" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Editar</Link>
                        <form :action="`/orders/${order.id}`" method="POST" class="inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Excluir</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </Layout>
</template>

<script setup>
import Layout from '@/Layouts/Layout.vue';

defineProps({
    orders: Array,
});
</script>
