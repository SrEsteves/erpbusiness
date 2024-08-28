<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const clientsCount = ref(120); // Exemplo de número total de clientes
const productsCount = ref(350); // Exemplo de número total de produtos
const salesToday = ref(15); // Exemplo de vendas realizadas hoje
const totalRevenue = ref('R$ 10,000'); // Exemplo de receita total
</script>

<template>
    <div>
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
            <div class="p-4 bg-white rounded-lg shadow">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75h19.5m-19.5 3.75h19.5m-19.5 3.75h19.5M2.25 18h19.5" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900">
                        Total de Clientes
                    </h2>
                </div>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    {{ clientsCount }} Clientes registrados.
                </p>
            </div>

            <div class="p-4 bg-white rounded-lg shadow">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3V3z" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900">
                        Produtos em Estoque
                    </h2>
                </div>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    {{ productsCount }} Produtos disponíveis.
                </p>
            </div>

            <div class="p-4 bg-white rounded-lg shadow">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900">
                        Vendas Hoje
                    </h2>
                </div>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    {{ salesToday }} Vendas realizadas hoje.
                </p>
            </div>

            <div class="p-4 bg-white rounded-lg shadow">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3V3z" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900">
                        Receita Total
                    </h2>
                </div>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    {{ totalRevenue }}
                </p>
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-900">
                    Clientes Recentes
                </h2>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    Aqui você pode adicionar uma tabela ou lista com os clientes que se registraram recentemente.
                </p>
            </div>

            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-900">
                    Produtos em Baixa
                </h2>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    Aqui você pode listar produtos que estão com o estoque abaixo do limite estipulado.
                </p>
            </div>
        </div>
    </div>
</template>
