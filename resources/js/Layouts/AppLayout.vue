<script setup>
import Navbar from '@/Components/Navbar.vue';
</script>

<template>
  <div class="min-h-screen bg-page-bg">
    <Navbar />

    <main class="max-w-[1440px] mx-auto px-4 lg:px-10 py-8">
      <slot />
    </main>
  </div>
</template>