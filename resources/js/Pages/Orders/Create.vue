<template>
    <Layout title="Criar Pedido">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Criar Pedido</h2>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitForm">
                    <div class="mb-4">
                        <label for="client_id" class="form-label">Cliente</label>
                        <select v-model="form.client_id" id="client_id" class="form-select">
                            <option v-for="client in clients" :value="client.id" :key="client.id">{{ client.name }}</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Produtos</label>
                        <div v-for="(product, index) in form.products" :key="index" class="mb-2">
                            <div class="input-group">
                                <select v-model="product.id" class="form-select" @change="updateMaxQuantity(index)">
                                    <option v-for="productOption in products" :value="productOption.id" :key="productOption.id">
                                        {{ productOption.name }}
                                    </option>
                                </select>
                                <input type="number" v-model="product.quantity" class="form-control" :max="getMaxQuantity(product.id)" placeholder="Quantidade">
                                <button type="button" @click="removeProduct(index)" class="btn btn-outline-danger">Remover</button>
                            </div>
                        </div>
                        <button type="button" @click="addProduct" class="btn btn-success mt-2">Adicionar Produto</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Pedido</button>
                </form>
            </div>
        </div>

        <!-- Toast Notification -->
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
            <div id="liveToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" v-if="showToast">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ toastMessage }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" @click="showToast = false" aria-label="Close"></button>
                </div>
            </div>
        </div>
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

const showToast = ref(false);
const toastMessage = ref('');

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

const getMaxQuantity = (productId) => {
    const product = props.products.find(p => p.id === productId);
    return product ? product.stock : 1;
};

const updateMaxQuantity = (index) => {
    const selectedProduct = form.products[index];
    const maxQuantity = getMaxQuantity(selectedProduct.id);
    if (selectedProduct.quantity > maxQuantity) {
        toastMessage.value = `A quantidade solicitada para o produto excede o estoque disponível (${maxQuantity})`;
        showToast.value = true;
        selectedProduct.quantity = maxQuantity;

        // Exibe o toast por 3 segundos
        setTimeout(() => {
            showToast.value = false;
        }, 3000);
    }
};
</script>
