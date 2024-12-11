<template>
    <MainLayout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <!-- Header Section -->
      <div class="max-w-7xl mx-auto text-center mb-12">
        <h1 class="text-4xl font-bold text-blue-500 mb-4">Hubungi Kami</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Punya pertanyaan atau ingin berkolaborasi? Jangan ragu untuk menghubungi kami.
          Tim kami siap membantu Anda.
        </p>
      </div>
  
      <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Information -->
        <div class="bg-white rounded-xl shadow-lg p-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kontak</h2>
  
          <div class="space-y-6">
            <!-- Contact Information Items -->
            <!-- Add your contact information items here as shown in your original code -->
          </div>
  
          <!-- Social Media Links -->
          <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Ikuti Kami</h3>
            <div class="flex space-x-4">
              <!-- Add your social media links here as shown in your original code -->
            </div>
          </div>
        </div>
  
        <!-- Contact Form -->
        <div class="bg-white rounded-xl shadow-lg p-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
              <input
                type="text"
                id="name"
                v-model="formData.name"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required
              />
            </div>
  
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input
                type="email"
                id="email"
                v-model="formData.email"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required
              />
            </div>
  
            <div>
              <label for="subject" class="block text-sm font-medium text-gray-700">Subjek</label>
              <input
                type="text"
                id="subject"
                v-model="formData.subject"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required
              />
            </div>
  
            <div>
              <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
              <textarea
                id="message"
                v-model="formData.message"
                rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required
              ></textarea>
            </div>
  
            <div>
              <button
                type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
              >
                Kirim Pesan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    </MainLayout>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import MainLayout from '@/Layouts/MainLayout.vue';
  
  const formData = ref({
    name: '',
    email: '',
    subject: '',
    message: ''
  })
  
  const handleSubmit = async () => {
    try {
      console.log('Form submitted:', formData.value)
      formData.value = {
        name: '',
        email: '',
        subject: '',
        message: ''
      }
      alert('Pesan berhasil dikirim!')
    } catch (error) {
      console.error('Error submitting form:', error)
      alert('Terjadi kesalahan. Silakan coba lagi.')
    }
  }
  </script>
  