<template>
  <AppLayout>
      <Banner />
      <ListTopics />
      <Content />
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Banner from '@/Components/Home/Banner.vue'
import ListTopics from '@/Components/Home/ListTopics.vue';
import Content from '@/Components/Home/Content.vue';
</script>