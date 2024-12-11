<template>
    <MainLayout>
    <section class="h-[1000px] flex items-center justify-center">
      <div class=" max-w-6xl h-[720px] p-64 mx-auto py-8 bg-white shadow-lg rounded-lg border items-center justify-center flex ">
        
        <div class="text-center px-6">
          <!-- Judul -->
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Gaya belajarmu adalah</h2>
  
          <!-- Bagian Persentase -->
          <div class="flex justify-between items-center gap-4 mb-8">
            <div
              v-for="(value, key) in results"
              :key="key"
              class="text-center flex-1"
              :class="{ 'opacity-50': !dominantStyles.includes(key) }"
            >
              <img
                :src="getImageForKey(key)"
                alt="Icon"
                class="w-48 h-48 mx-auto "
              />
              <p class="text-lg font-semibold mt-2 text-gray-900">{{ value }}%</p>
              <p class="text-sm text-gray-600">{{ key }}</p>
            </div>
          </div>
  
          <!-- Gaya Belajar Dominan -->
          <div class="mb-6">
            <h3 class="text-3xl font-bold text-gray-800">{{ dominantStyles.join(', ') }}</h3>
          </div>
  
          <!-- Deskripsi Gaya Belajar -->
          <div class="text-gray-700 text-base leading-relaxed">
            <p>{{ description }}</p>
          </div>
  
          <!-- Tombol Kembali -->
          <div class="mt-8">
            <button
              @click="goBack"
              class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition-all"
            >
              Kembali
            </button>
          </div>
        </div>
      </div>
    </section>
    </MainLayout>
  </template>
  
  <script setup>
  import { usePage, router } from '@inertiajs/vue3';
  import MainLayout from '@/Layouts/MainLayout.vue';
  
  // Fetch props from backend
  const { props } = usePage();
  const results = props.results || {};
  const dominantStyles = props.dominantStyles || [];
  const description = props.description || '';
  
  // Get image based on learning style
  const getImageForKey = (key) => {
    const images = {
      Visual: '/images/visual.png',
      Auditori: '/images/auditori.png',
      Kinestetik: '/images/kinestetik.png',
    };
    return images[key] || '/images/default.png';
  };
  
  // Go back to the main page
  const goBack = () => {
    router.get('/');
  };
  </script>
  