<template>
    <!-- Header Content -->
    <HeaderContent />
  
    <div class="flex">
      <!-- Sidebar: memberikan lebar tetap pada sidebar -->
      <Sidebar class="w-64 h-[1200px] bg-gray-800 text-white" />
      
      <!-- Main Content Area: Menyesuaikan lebar sisa ruang -->
      <main class="flex-1 p-6 bg-gray-100">
        <!-- Slot for dynamic content -->
        <slot></slot>
      </main>
    </div>
  
    <!-- Footer Content -->
    <FooterContent />
  </template>
  
  <script setup lang="js">
  import HeaderContent from '@/Components/HeaderContent.vue';
  import FooterContent from '@/Components/FooterContent.vue';
  import Sidebar from '@/Components/Sidebar.vue';
  </script>
  
  <style scoped>
  /* Optional: Add global styles for layout */
  </style>
  