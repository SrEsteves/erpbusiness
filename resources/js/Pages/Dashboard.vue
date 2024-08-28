<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Layout from '@/Layouts/Layout.vue';

// Recebendo os dados do controlador
const props = defineProps({
    clientsCount: Number,
    productsCount: Number,
    salesToday: Number,
    totalRevenue: String,
    recentClients: Array,
    lowStockProducts: Array,
});
</script>

<template>
    <Layout title="Dashboard">
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <ApplicationLogo class="block h-12 w-auto" />

            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                Bem-vindo ao ERPBusiness Dashboard!
            </h1>

            <p class="mt-6 text-gray-500 leading-relaxed">
                Aqui você encontra uma visão geral das atividades e indicadores principais do seu sistema de ERP.
            </p>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
            <div class="p-4 bg-white rounded-lg shadow flex items-center">
                <div class="text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Total de Clientes
                    </h2>
                    <p class="mt-2 text-gray-500 text-sm">
                        {{ props.clientsCount }} Clientes registrados.
                    </p>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow flex items-center">
                <div class="text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3V3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Produtos em Estoque
                    </h2>
                    <p class="mt-2 text-gray-500 text-sm">
                        {{ props.productsCount }} Produtos disponíveis.
                    </p>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow flex items-center">
                <div class="text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.75V19.25M4.75 12H19.25" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Vendas Hoje
                    </h2>
                    <p class="mt-2 text-gray-500 text-sm">
                        {{ props.salesToday }} Vendas realizadas hoje.
                    </p>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg shadow flex items-center">
                <div class="text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.75V19.25M4.75 12H19.25" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Receita Total
                    </h2>
                    <p class="mt-2 text-gray-500 text-sm">
                        R$ {{ props.totalRevenue }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-900">
                    Clientes Recentes
                </h2>
                <ul class="mt-4 text-gray-500 text-sm leading-relaxed">
                    <li v-for="client in props.recentClients" :key="client.id" class="mb-2">
                        {{ client.name }} - {{ client.email }}
                    </li>
                </ul>
            </div>

            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-900">
                    Produtos em Baixa
                </h2>
                <ul class="mt-4 text-gray-500 text-sm leading-relaxed">
                    <li v-for="product in props.lowStockProducts" :key="product.id" class="mb-2">
                        {{ product.name }} - Estoque: {{ product.stock }}
                    </li>
                </ul>
            </div>
        </div>
    </Layout>
</template>
