<template>
    <div class="min-h-screen bg-gray-50">
      <!-- Header -->
      <MainLayout>
  
      <!-- Main Content -->
      <main class="flex flex-col items-center justify-center px-4 py-8 max-w-6xl mx-auto h-[1000px]">
  
        <!-- Help Items -->
        <div class="w-full space-y-8">
          <!-- Question 1 -->
          <div class="bg-white rounded-[50px] shadow-md p-8">
            <h2 class="text-2xl text-black mb-4">
              Dimana saya dapat melihat hasil tes gaya belajar?
            </h2>
            <p class="text-gray-700">
              Pada bagian menu aku, di bagian dashboard akan menampilkan hasil gaya belajar terakhir beserta hasil riwayat gaya belajar yang telah dilakukan sebelumnya.
            </p>
          </div>
  
          <!-- Question 2 -->
          <div class="bg-white rounded-[50px] shadow-md p-8">
            <h2 class="text-2xl text-black mb-4">
              Apa manfaat yang saya dapatkan apabila melakukan test gaya belajar di Aplikasi Studysync?
            </h2>
            <p class="text-gray-700">
              User akan mendapatkan hasil yang akurat, serta akan mendapatkan hasil yang sesuai dengan kebribadian user, sehingga mempermudah user untuk mempercepat proses pembelajaran tanpa perlu membuang waktu untuk mencari tahu gaya belajar yang sesuai dengan user.
            </p>
          </div>
  
          <!-- Question 3 -->
          <div class="bg-white rounded-[50px] shadow-md p-8">
            <h2 class="text-2xl text-black mb-4">
              Dimana saya dapat melihat akun sosmed Aplikasi Studysync?
            </h2>
            <p class="text-gray-700">
              Pada bagian footer di setiap halaman akan menampilkan akun social media dari Aplikasi Studysync
            </p>
          </div>
  
          <!-- Question 4 -->
          <div class="bg-white rounded-[50px] shadow-md p-8">
            <h2 class="text-2xl text-black mb-4">
              Dimana saya dapat melihat pusat akun?
            </h2>
            <p class="text-gray-700">
              Pada bagian pojok kanan atas pada navbar akan menampilkan icon user
            </p>
          </div>
        </div>
      </main>
  
      <!-- Footer -->
      </MainLayout>
    </div>
  </template>
  
  <script setup>
  import MainLayout from '@/Layouts/MainLayout.vue';
  </script>