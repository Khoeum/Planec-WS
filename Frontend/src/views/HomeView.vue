<template>
  <div class="min-h-screen bg-gray-50">

    <!-- Hero Slideshow -->
    <section class="relative h-screen overflow-hidden">

      <!-- Slides -->
      <div v-for="(slide, index) in slides" :key="index" class="absolute inset-0 transition-opacity duration-1000"
        :class="currentSlide === index ? 'opacity-100 z-10' : 'opacity-0 z-0'">
        <!-- Background -->
        <div class="absolute inset-0 bg-cover bg-center" :style="{ backgroundImage: `url(${slide.image})` }"></div>

        <!-- Lighter Overlay -->
        <div class="absolute inset-0 bg-black/25"></div>

        <!-- Gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>

        <!-- Content -->
        <div class="relative z-20 h-full flex items-center justify-center text-center px-6">
          <div class="max-w-4xl">
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 drop-shadow-lg">
              {{ slide.title }}
            </h1>

            <p class="text-xl md:text-2xl text-gray-100 mb-10 drop-shadow-md">
              {{ slide.description }}
            </p>
          </div>
        </div>
      </div>

      <!-- Indicators -->
      <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex gap-3 z-30">
        <button v-for="(slide, index) in slides" :key="index" @click="currentSlide = index"
          class="w-4 h-4 rounded-full transition duration-300"
          :class="currentSlide === index ? 'bg-white scale-125' : 'bg-white/60'"></button>
      </div>

      <!-- Arrows -->
      <button @click="prevSlide"
        class="absolute left-8 top-1/2 -translate-y-1/2 z-30 bg-white/20 backdrop-blur-md text-white p-4 rounded-full hover:bg-white/40 transition">
        ←
      </button>

      <button @click="nextSlide"
        class="absolute right-8 top-1/2 -translate-y-1/2 z-30 bg-white/20 backdrop-blur-md text-white p-4 rounded-full hover:bg-white/40 transition">
        →
      </button>
    </section>

    <!-- Services -->
    <section class="py-24 bg-white">
      <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">
          <h2 class="text-5xl font-bold text-blue-800 mb-4">
            Our Services
          </h2>

          <p class="text-gray-600 text-lg">
            Professional networking and infrastructure solutions
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
          <div v-for="(service, index) in services" :key="index"
            class="bg-white rounded-3xl shadow-lg hover:shadow-2xl p-10 text-center transition duration-300 hover:-translate-y-2">
            <div
              class="w-24 h-24 bg-blue-700 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl text-white">
              {{ service.icon }}
            </div>

            <h3 class="text-2xl font-bold text-blue-800 mb-4">
              {{ service.title }}
            </h3>

            <p class="text-gray-600 leading-relaxed">
              {{ service.description }}
            </p>
          </div>
        </div>

      </div>
    </section>

  </div>
</template>

<script>
export default {
  name: 'HomeView',

  data() {
    return {
      currentSlide: 0,
      intervalId: null,

      slides: [
        {
          image: 'https://planec.com.kh/wp-content/uploads/2019/11/Banner_WAPC_Video_201907-1440x432.jpg',
        },
        {
          image: 'https://planet.com.tw/storage/products/49093/edm_WDAP-C7200E_L1.jpg',
        },
        {
          image: 'https://planet.com.tw/storage/products/48987/GS-5220-24UPL4X_R-2_L.jpg',
        }
      ],

      services: [
        {
          icon: '💻',
          title: 'Data Center Solution',
          description:
            'Reliable infrastructure to support secure enterprise information systems.'
        },
        {
          icon: '🏢',
          title: 'Building Solution',
          description:
            'High-bandwidth networking and structured cabling for smart buildings.'
        },
        {
          icon: '🏭',
          title: 'Factory Solution',
          description:
            'Industrial networking systems designed for manufacturing operations.'
        }
      ]
    }
  },

  methods: {
    nextSlide() {
      this.currentSlide = (this.currentSlide + 1) % this.slides.length
    },

    prevSlide() {
      this.currentSlide =
        (this.currentSlide - 1 + this.slides.length) % this.slides.length
    }
  },

  mounted() {
    this.intervalId = setInterval(() => {
      this.nextSlide()
    }, 5000)
  },

  beforeUnmount() {
    clearInterval(this.intervalId)
  }
}
</script>

