<template>
    <Layout title="Editar Produto">
      <form :action="`/products/${product.id}`" method="POST" @submit.prevent="submitForm">
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-4">
          <label for="name" class="block text-gray-700">Nome</label>
          <input type="text" v-model="form.name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
          <label for="description" class="block text-gray-700">Descrição</label>
          <textarea v-model="form.description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
        </div>
        <div class="mb-4">
          <label for="price" class="block text-gray-700">Preço</label>
          <input type="number" v-model="form.price" id="price" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
          <label for="stock" class="block text-gray-700">Estoque</label>
          <input type="number" v-model="form.stock" id="stock" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
      </form>
    </Layout>
  </template>
  
  <script>
  import Layout from '@/Layouts/Layout.vue';
  
  export default {
    components: {
      Layout
    },
    props: {
      product: Object
    },
    data() {
      return {
        form: {
          name: this.product.name,
          description: this.product.description,
          price: this.product.price,
          stock: this.product.stock
        }
      }
    },
    methods: {
        submitForm() {
            axios.put(`/products/${this.product.id}`, this.form)
            .then(response => {
                window.location.href = '/products';
            })
            .catch(error => {
                console.error(error.response.data);
            });
        }
    }
  }
  </script>
  