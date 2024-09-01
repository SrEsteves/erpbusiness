<template>
    <Layout title="Criar Pedido">
        <h1 class="text-2xl font-bold">Criar Pedido</h1>
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label for="client_id" class="block text-gray-700">Cliente</label>
                <select v-model="form.client_id" id="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option v-for="client in clients" :value="client.id" :key="client.id">{{ client.name }}</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Produtos</label>
                <div v-for="(product, index) in form.products" :key="index" class="flex space-x-2 mb-2">
                    <select v-model="product.id" class="w-1/2 border-gray-300 rounded-md shadow-sm">
                        <option v-for="productOption in products" :value="productOption.id" :key="productOption.id">
                            {{ productOption.name }}
                        </option>
                    </select>
                    <input type="number" v-model="product.quantity" class="w-1/4 border-gray-300 rounded-md shadow-sm" placeholder="Quantidade">
                    <button type="button" @click="removeProduct(index)" class="text-red-500">Remover</button>
                </div>
                <button type="button" @click="addProduct" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Adicionar Produto</button>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Salvar Pedido</button>
        </form>
    </Layout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';

const props = defineProps({
    clients: Array,
    products: Array,
    order: Object,
});

const form = useForm({
    client_id: props.order?.client_id || '',
    products: props.order?.products.map(p => ({ id: p.id, quantity: p.pivot.quantity })) || [],
});

const submitForm = () => {
    if (props.order) {
        form.put(`/orders/${props.order.id}`);
    } else {
        form.post('/orders');
    }
};

const addProduct = () => {
    form.products.push({ id: '', quantity: 1 });
};

const removeProduct = (index) => {
    form.products.splice(index, 1);
};
</script>
