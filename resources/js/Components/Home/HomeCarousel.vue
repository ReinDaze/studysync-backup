<template>
    <section class="py-20 bg-[#EEF3FF]">
      <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-16">Kenali Gaya Belajar</h2>
        
        <!-- Carousel Component -->
        <div class="relative w-full">
          <div class="overflow-hidden">
            <div class="flex transition-transform duration-300 ease-in-out" 
                 :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
              
              <!-- Visual Slide -->
              <div class="w-full flex-shrink-0 px-4">
                <div class="max-w-4xl mx-auto">
                  <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/2">
                      <img 
                        src="../../../../public/images/visual.png"
                        alt="Visual Learning" 
                        class="w-full h-auto"
                      />
                    </div>
                    <div class="md:w-1/2 text-center md:text-left">
                      <h3 class="text-3xl font-semibold text-blue-600 mb-4">Visual</h3>
                      <p class="text-blue-800 text-lg">
                        Seseorang dengan gaya belajar visual mengandalkan penglihatan sebagai cara utama untuk memahami informasi. Orang dengan gaya ini cenderung lebih mudah mengingat grafik, diagram, gambar, dan video.
                      </p>
                    </div>
                  </div>
                </div>  
              </div>

              <!-- Auditori Slide -->
              <div class="w-full flex-shrink-0 px-4">
                <div class="max-w-4xl mx-auto">
                  <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/2">
                      <img 
                        src="../../../../public/images/auditori.png"
                        class="w-full h-auto"
                      />
                    </div>
                    <div class="md:w-1/2 text-center md:text-left">
                      <h3 class="text-3xl font-semibold text-blue-600 mb-4">Auditori</h3>
                      <p class="text-blue-800 text-lg">
                        Seseorang dengan gaya belajar auditori akan mengutamakan pendengaran untuk memperoleh informasi seperti mendengar kuliah. Banyak dari mereka menyerap informasi ketika mendengarkan speech atau mendengarkan ceramah, diskusi, atau audio.
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Kinestetik Slide -->
              <div class="w-full flex-shrink-0 px-4">
                <div class="max-w-4xl mx-auto">
                  <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/2">
                      <img 
                        src="../../../../public/images/kinestetik.png"
                        alt="Kinesthetic Learning" 
                        class="w-full h-auto"
                      />
                    </div>
                    <div class="md:w-1/2 text-center md:text-left">
                      <h3 class="text-3xl font-semibold text-blue-600 mb-4">Kinestetik</h3>
                      <p class="text-blue-800 text-lg">
                        Seseorang dengan gaya belajar kinestetik lebih mudah menerima dan memproses informasi ketika mereka dapat mencoba atau melakukannya secara langsung. Orang dengan gaya ini cenderung lebih mudah belajar dengan melakukan sesuatu secara langsung.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Navigation Buttons -->
          <button 
            @click="prevSlide" 
            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all"
            :class="{ 'invisible': currentIndex === 0 }"
          >
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </button>

          <button 
            @click="nextSlide" 
            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all"
            :class="{ 'invisible': currentIndex === 2 }"
          >
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>

          <!-- Dots Navigation -->
          <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 flex space-x-3">
            <button 
              v-for="(_, index) in 3" 
              :key="index"
              @click="goToSlide(index)"
              class="w-3 h-3 rounded-full transition-colors duration-200 border-2 border-blue-500"
              :class="index === currentIndex ? 'bg-blue-500' : 'bg-transparent'"
            ></button>
          </div>
        </div>
      </div>
    </section>
</template>

<script>
export default {
    data() {
    return {
      currentIndex: 0,
    }
  },
  methods: {
    nextSlide() {
      if (this.currentIndex < 2) {
        this.currentIndex++
      }
    },
    prevSlide() {
      if (this.currentIndex > 0) {
        this.currentIndex--
      }
    },
    goToSlide(index) {
      this.currentIndex = index
    }
  }
}
</script>