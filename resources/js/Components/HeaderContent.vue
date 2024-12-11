<template>
  <header class="flex flex-wrap gap-5 justify-between my-auto px-14 py-7 w-full bg-white shadow-[0px_4px_4px_rgba(0,0,0,0.25)] max-md:px-5 max-md:max-w-full">
    <div class="flex items-center">
      <img src="../../../public/images/studysync.png" alt="StudySync Logo" class="w-6 h-8 mr-6" />
      <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-purple-600 animate-pulse">
        StudySync
      </h1>
    </div>

    <nav class="flex flex-wrap gap-10 items-center max-md:max-w-full">
      <Link href="/" class="text-xl font-medium text-blue-500 hover:text-blue-700 transition-colors duration-300">
        Beranda
      </Link>
      <Link href="/tes-gaya-belajar" class="text-xl font-medium text-blue-500 hover:text-blue-700 transition-colors duration-300">
        Tes Gaya Belajar
      </Link>
      <Link href="/kontak" class="text-xl font-medium text-blue-500 hover:text-blue-700 transition-colors duration-300">
        Kontak
      </Link>
      <Link href="/bantuan" class="text-xl font-medium text-blue-500 hover:text-blue-700 transition-colors duration-300">
        Bantuan
      </Link>

      <!-- Check if the user is authenticated -->
      <template v-if="user">
        <!-- Dropdown for authenticated user -->
        <div class="relative">
          <Dropdown align="right" width="48">
            <template #trigger>
              <button
                type="button"
                class="inline-flex items-center rounded-full bg-blue-500 text-white px-4 py-2 text-sm font-medium leading-4 transition duration-300 ease-in-out hover:bg-blue-600"
              > 
                <!-- Profile Icon -->
                <svg
                  class="w-6 h-6 mr-2 text-white"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"
                  />
                </svg>
                <span class="font-semibold">{{ user.name }}</span>
                <svg
                  class="h-4 w-4 ml-2 text-white"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  />
                </svg>
              </button>
            </template>

            <template #content>
              <DropdownLink :href="route('dashboarduser')" class="text-sm text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-md">
                Profile
              </DropdownLink>
              <DropdownLink :href="route('logout')" method="post" as="button" class="text-sm text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-md">
                Log Out
              </DropdownLink> 
            </template>
          </Dropdown>
        </div>
      </template>

      <!-- Login button for unauthenticated user -->
      <template v-else>
        <button @click="login" class="px-6 py-2 text-xl font-bold text-white bg-blue-500 rounded-full hover:bg-blue-600 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
          Login
        </button>
      </template>
    </nav>
  </header>
</template>

<script>
import { Link, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

export default {
  name: 'StudySyncHeader',
  components: {
    Link,
    Dropdown,
    DropdownLink,
  },
  data() {
    return {
      user: null, // This will hold the user data
    };
  },
  mounted() {
    // Fetch the logged-in user data
    this.user = this.$page.props.auth.user;
  },
  methods: {
    login() {
      this.$inertia.visit('/login');
    },
  },
};
</script>
