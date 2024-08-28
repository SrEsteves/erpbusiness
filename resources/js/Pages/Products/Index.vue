<template>
    <Layout title="Lista de Produtos">
      <div class="mb-4">
        <a href="/products/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Adicionar Produto
        </a>
      </div>
      <table class="min-w-full bg-white border border-gray-200">
        <thead>
          <tr>
            <th class="px-4 py-2 text-left text-gray-600 border-b">Nome</th>
            <th class="px-4 py-2 text-left text-gray-600 border-b">Descrição</th>
            <th class="px-4 py-2 text-left text-gray-600 border-b">Preço</th>
            <th class="px-4 py-2 text-left text-gray-600 border-b">Estoque</th>
            <th class="px-4 py-2 text-left text-gray-600 border-b">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id" class="hover:bg-gray-100">
            <td class="px-4 py-2 border-b">{{ product.name }}</td>
            <td class="px-4 py-2 border-b">{{ product.description }}</td>
            <td class="px-4 py-2 border-b">{{ product.price | currency }}</td>
            <td class="px-4 py-2 border-b">{{ product.stock }}</td>
            <td class="px-4 py-2 border-b">
              <a :href="`/products/${product.id}/edit`" class="text-blue-500 hover:underline">Editar</a> |
              <form :action="`/products/${product.id}`" method="POST" class="inline">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" :value="csrfToken">
                <button type="submit" class="text-red-500 hover:underline">Excluir</button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </Layout>
  </template>
  
  <script>
  import Layout from '@/Layouts/Layout.vue';
  
  export default {
    components: {
      Layout
    },
    props: {
      products: Array,
      csrfToken: String,
    },
    filters: {
      currency(value) {
        if (!value) return '';
        return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value);
      }
    }
  }
  </script>
  