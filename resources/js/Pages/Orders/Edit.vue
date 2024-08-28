<template>
    <Layout title="Editar Pedido">
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label for="client_id" class="block text-gray-700">Cliente</label>
                <select v-model="form.client_id" id="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option v-for="client in clients" :key="client.id" :value="client.id">
                        {{ client.name }}
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <label for="total_price" class="block text-gray-700">Total</label>
                <input type="number" v-model="form.total_price" id="total_price" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
        </form>
    </Layout>
</template>

<script setup>
import Layout from '@/Layouts/Layout.vue';

defineProps({
    order: Object,
    clients: Array,
});

const form = ref({
    client_id: order.client_id,
    total_price: order.total_price,
});

function submitForm() {
    axios.put(`/orders/${order.id}`, form.value)
        .then(response => {
            window.location.href = '/orders';
        })
        .catch(error => {
            console.error(error.response.data);
        });
}
</script>
