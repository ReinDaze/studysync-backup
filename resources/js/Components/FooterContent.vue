<template>
  <footer class="bg-blue-500 px-6 md:px-12 lg:px-20 py-12 w-full">
    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="flex flex-col md:flex-row md:justify-between items-start mb-12">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-4 md:mb-0">
          Kontak Kami
        </h2>
        <h2 class="text-4xl lg:text-5xl font-bold text-white">
          Studysync
        </h2>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-12">
        <!-- Brand and Social Links Section -->
        <div class="lg:col-span-3">
          <div class="space-y-6">
            <!-- Brand -->
            <div class="flex items-center space-x-4">
              <img 
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/b86a120459633d5f01185f9b0ed1511bfefc0f2c0accb8aa9c8321ce199d4ba2"
                alt="Studysync logo" 
                class="w-8 h-8 object-contain"
              />
              <span class="text-2xl text-white">studysync</span>
            </div>
            
            <!-- Contact Links -->
            <div class="space-y-6">
              <!-- Email -->
              <div class="flex items-center space-x-4">
                <img 
                  src="https://cdn.builder.io/api/v1/image/assets/TEMP/cd28cbdf490ec1a598f09de5bf372c6248e83d4b00ff56643502267b937302ee"
                  alt="Email icon" 
                  class="w-8 h-8 object-contain"
                />
                <span class="text-xl text-white">studysync@study.com</span>
              </div>
              
              <!-- Social Media -->
              <div class="flex items-center space-x-4">
                <img 
                  src="https://cdn.builder.io/api/v1/image/assets/TEMP/7ace1654c310096284ea7c9553054c7d84eec5cc8ff5ae73db64c845c388f637"
                  alt="Social media icon" 
                  class="w-8 h-8 object-contain"
                />
                <span class="text-xl text-white">study.sync</span>
              </div>
              
              <!-- Video Platform -->
              <div class="flex items-center space-x-4">
                <img 
                  src="https://cdn.builder.io/api/v1/image/assets/TEMP/b4d6ee49134990a64b4deea66009db3ff7acd88d5b9c74a6681edaf6e5bfad1c"
                  alt="Video platform icon" 
                  class="w-8 h-8 object-contain"
                />
                <span class="text-xl text-white">study tube</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Location and Contact Section -->
        <div class="lg:col-span-3">
          <div class="space-y-6">
            <!-- Location -->
            <div class="flex items-center space-x-4">
              <img 
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/ca6d73b5547c5a6fa9da685fe1e22bffc2f69ad8d99ffed016635a86b36b42ee"
                alt="Location icon" 
                class="w-8 h-8 object-contain"
              />
              <span class="text-xl text-white">studysync</span>
            </div>
            
            <!-- Phone -->
            <div class="flex items-center space-x-4">
              <img 
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/74e34ca780f9f73b0679a5ba996f1afd12f56f93622d073ca053dd93362b324f"
                alt="Phone icon" 
                class="w-8 h-8 object-contain"
              />
              <span class="text-xl text-white">+62 888 888 888</span>
            </div>
            
            <!-- Address -->
            <address class="text-xl text-white not-italic mt-6">
              Hotel Asia lt. 21<br />
              Jln. Jomokerto Jomo Mojokerto
            </address>
          </div>
        </div>

        <!-- Description Section -->
        <div class="lg:col-span-6">
          <p class="text-xl text-white leading-relaxed">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod 
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim 
            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea 
            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate 
            velit esse cillum dolore.
          </p>
        </div>
      </div>
    </div>
  </footer>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'FooterComponent',
});
</script>