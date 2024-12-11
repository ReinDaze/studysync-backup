<template>
  <div class="w-64 bg-white text-white min-h-screen z--20">
    <div class="p-6">

      <!-- Menu Navigasi -->
      <nav class="flex flex-col space-y-6">
        <Link href="/dashboard-user"
          class="flex items-center text-blue-500 hover:bg-blue-200 p-3 rounded-md transition-colors duration-300">
        <!-- Icon Dashboard -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-6 h-6 mr-4">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
        </svg>


        Dashboard
        </Link>

        <Link href="/profile"
          class="flex items-center text-blue-500 hover:bg-blue-200 p-3 rounded-md transition-colors duration-300">
        <!-- Icon Profile -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-6 h-6 mr-4">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
        </svg>

        Edit Profile
        </Link>

        <Link href="/riwayat-test"
          class="flex items-center text-blue-500 hover:bg-blue-200 p-3 rounded-md transition-colors duration-300">
        <!-- Icon Riwayat Test -->
        <svg class="w-6 h-6 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M2 12a10 10 0 1110 10 10 10 0 01-10-10z"></path>
        </svg>
        Riwayat Gaya Belajar
        </Link>

        <Link href="/logout" method="post"
          class="flex items-center text-blue-500 hover:bg-blue-200 p-3 rounded-md transition-colors duration-300">
        <!-- Icon Log Out -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-6 h-6 mr-4">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>

        Log Out
        </Link>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';  // Pastikan menggunakan Link dari inertiajs/vue3
</script>
