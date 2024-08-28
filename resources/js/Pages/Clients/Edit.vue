<template>
    <Layout title="Editar Cliente">
      <form @submit.prevent="submitForm">
        <div class="mb-4">
          <label for="name" class="block text-gray-700">Nome</label>
          <input type="text" v-model="form.name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700">Email</label>
          <input type="email" v-model="form.email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
          <label for="phone" class="block text-gray-700">Telefone</label>
          <input type="text" v-model="form.phone" id="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
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
      client: Object
    },
    data() {
      return {
        form: {
          name: this.client.name,
          email: this.client.email,
          phone: this.client.phone
        }
      }
    },
    methods: {
      submitForm() {
        axios.put(`/clients/${this.client.id}`, this.form)
          .then(response => {
            window.location.href = '/clients';
          })
          .catch(error => {
            console.error(error.response.data);
          });
      }
    }
  }
  </script>
  