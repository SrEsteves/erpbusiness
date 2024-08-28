<template>
  <Layout title="Lista de Clientes">
    <div class="mb-4">
      <a href="/clients/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Adicionar Cliente
      </a>
    </div>
    <table class="min-w-full bg-white border border-gray-200">
      <thead>
        <tr>
          <th class="px-4 py-2 text-left text-gray-600 border-b">Nome</th>
          <th class="px-4 py-2 text-left text-gray-600 border-b">Email</th>
          <th class="px-4 py-2 text-left text-gray-600 border-b">Telefone</th>
          <th class="px-4 py-2 text-left text-gray-600 border-b">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="client in clients" :key="client.id" class="hover:bg-gray-100">
          <td class="px-4 py-2 border-b">{{ client.name }}</td>
          <td class="px-4 py-2 border-b">{{ client.email }}</td>
          <td class="px-4 py-2 border-b">{{ client.phone }}</td>
          <td class="px-4 py-2 border-b">
            <a :href="`/clients/${client.id}/edit`" class="text-blue-500 hover:underline">Editar</a> |
            <form :action="`/clients/${client.id}`" method="POST" class="inline">
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
    clients: Array,
    csrfToken: String,
  }
}
</script>
