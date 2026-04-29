<script setup>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import { RouterView } from 'vue-router'
</script>

<template>
  <div>
    <Navbar />

    <main>
      <RouterView />
    </main>

    <Footer />
  </div>
</template>
<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
}

main {
  min-height: 80vh;
}
</style>