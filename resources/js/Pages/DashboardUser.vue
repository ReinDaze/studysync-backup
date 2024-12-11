<template>
  <SidebarLayout>
    <div class="container mx-auto py-8 px-4 z-20">

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">

      
        <div class="max-w-full w-full bg-white shadow-lg rounded-lg p-8">
          <p class="text-xl font-semibold text-gray-800">Profil Pengguna</p>
          <p class="text-lg font-medium text-gray-600">{{ user.name }}</p>
          <div class="mt-8">
            <p class="text-sm font-medium text-gray-500">Gaya Belajar Terakhir:</p>
            <div v-if="learningHistory && learningHistory.length > 0">
              <div v-for="history in learningHistory.slice(0, 1)" :key="history.id">
                
                <div class="flex justify-center space-x-8 mt-4">
                  
                  <div class="flex-1 text-center">
                    <p class="text-2xl font-semibold text-blue-500">{{ history.visual_score }}%</p>
                    <p class="text-sm text-gray-600">Visual</p>
                  </div>
                  
                  <div class="flex-1 text-center">
                    <p class="text-2xl font-semibold text-blue-500">{{ history.auditori_score }}%</p>
                    <p class="text-sm text-gray-600">Auditori</p>
                  </div>
                  
                  <div class="flex-1 text-center">
                    <p class="text-2xl font-semibold text-blue-500">{{ history.kinestetik_score }}%</p>
                    <p class="text-sm text-gray-600">Kinestetik</p>
                  </div>
                </div>
              </div>
            </div>
            <div v-else>
              <p class="text-sm text-gray-600">Belum ada riwayat gaya belajar.</p>
            </div>
          </div>

      <div class="mt-12">
        <p class="text-sm font-medium text-gray-500">Kelengkapan Profil</p>
        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
          <div class="bg-blue-500 h-2.5 rounded-full" :style="{ width: completeness + '%' }"></div>
        </div>
        <p class="mt-1 text-sm font-medium text-gray-600">{{ completeness }}% Lengkap</p>
      </div>
    </div>


    
    <div class="max-w-full w-full bg-white shadow-lg rounded-lg p-8">
      <p class="text-xl font-semibold text-gray-800">Biodata</p>
      <div class="space-y-4 mt-4">
        <p class="text-m font-medium text-gray-600">Nama: {{ user.name }}</p>
        <p class="text-m font-medium text-gray-600">Email: {{ user.email }}</p>
        <p class="text-m font-medium text-gray-600">Telepon: {{ user.phone }}</p>
        <p class="text-m font-medium text-gray-600">Tanggal Lahir: {{ formatDate(user.birthdate) }}</p>
        <p class="text-m font-medium text-gray-600">Alamat: {{ user.address }}</p>
        <p class="text-m font-medium text-gray-600">Asal Sekolah: {{ user.school_origin }}</p>
      </div>
    </div>

    
    <div class="max-w-full w-full bg-white shadow-lg rounded-lg p-8">
      <p class="text-xl font-semibold text-gray-800 mb-4">Riwayat Gaya Belajar</p>
      <div class="space-y-4">
        <div v-for="history in learningHistory" :key="history.id" class="bg-white shadow-md rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
    
              <div class="w-12 h-12 rounded-full bg-blue-500 flex justify-center items-center">
                <img :src="getIcon(history.dominant_style)" alt="icon" class="w-8 h-8" />
              </div>
    
              <div class="ml-4">
                <p class="text-lg font-semibold text-gray-700">{{ history.dominant_style }}</p>
                <p class="text-sm text-gray-500">Persentase: {{ getHighestPercentage(history) }}%</p>
              </div>
            </div>
    
            <p class="text-sm text-gray-500">{{ formatDate(history.created_at) }}</p>
          </div>
        </div>
      </div>
    </div>

    
    <div class="max-w-full w-full bg-white shadow-lg rounded-lg p-8">
      <p class="text-xl font-semibold text-gray-800 mb-4">Tips and Trick Gaya Belajar</p>
      <div class="space-y-4">
        <div class="space-y-6">
          <div v-for="style in ['Visual', 'Auditori', 'Kinestetik']" :key="style" class="bg-blue-600 p-4 rounded-lg">
            <h3 class="font-bold text-white">{{ style }} Style</h3>
            <p class="text-sm text-white mt-2">{{ getTips(style) }}</p>
          </div>
        </div>
      </div>
    </div>

    </div>
    </div>
  </SidebarLayout>
</template>

<script setup>
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const { user, learningHistory } = usePage().props;

// Menghitung kelengkapan profil
const completeness = Math.round(
  (Object.values(user)
    .filter((value, key) => key !== 'birthdate' && value && value !== '').length
    / Object.keys(user).filter(key => key !== 'birthdate').length) * 100
);

// Fungsi untuk mendapatkan ikon berdasarkan gaya belajar
function getIcon(dominantStyle) {
  const icons = {
    Visual: '/images/visual.png',
    Auditori: '/images/auditori.png',
    Kinestetik: '/images/kinestetik.png'
  };
  return icons[dominantStyle] || '/images/multi.png';
}

// Fungsi untuk memformat tanggal
function formatDate(date) {
  return new Date(date).toLocaleDateString('id-ID', {
    year: 'numeric', month: 'long', day: 'numeric'
  });
}


// Fungsi untuk menghitung persentase tertinggi di riwayat gaya belajar
function getHighestPercentage(history) {
  const maxScore = Math.max(history.visual_score, history.auditori_score, history.kinestetik_score);
  return maxScore; // Return the highest score as percentage
}

// Tips berdasarkan gaya belajar
function getTips(style) {
  const tips = {
    Visual: 'Gunakan diagram, gambar, dan catatan visual untuk mempermudah pemahaman materi.',
    Auditori: 'Dengarkan penjelasan dengan cermat dan gunakan rekaman audio untuk belajar.',
    Kinestetik: 'Cobalah untuk melibatkan tubuh saat belajar, seperti dengan eksperimen atau simulasi.'
  };
  return tips[style] || 'Tips tidak tersedia';
}
</script>
