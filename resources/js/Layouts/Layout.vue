<template>
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
          <div class="text-white text-lg font-semibold">
            <a href="/">ERPBusiness</a>
          </div>
          <div class="space-x-4">
            <a href="/dashboard" class="text-white">Dashboard</a>
            <a href="/clients" class="text-white">Clientes</a>
            <a href="/products" class="text-white">Produtos</a>
          </div>
        </div>
      </nav>
  
      <header class="bg-white shadow">
        <div class="container mx-auto py-6 px-4">
          <h1 class="text-2xl font-bold text-gray-900">
            {{ title }}
          </h1>
        </div>
      </header>
  
      <main>
        <div class="container mx-auto py-6 px-4">
          <slot></slot>
        </div>
      </main>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      title: {
        type: String,
        default: 'Dashboard'
      }
    }
  }
  </script>
  