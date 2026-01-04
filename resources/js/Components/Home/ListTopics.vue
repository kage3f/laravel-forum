<script setup>
import { ref, onMounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import axios from 'axios';

const categories = ref([]);
const loading = ref(true);

onMounted(async () => {
    try {
        const response = await axios.get('/api/categories');
        categories.value = response.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    } finally {
        loading.value = false;
    }
});
</script>

<template>
  <div class="w-full mt-8">
    <div class="w-full flex justify-between items-center">
        <h3 class="text-xl text-white font-bold">Explorar Categorias</h3>
        <Link href="/topicos" class="text-sm text-primary font-semibold hover:underline">Ver todas</Link>
    </div>
    
    <div v-if="loading" class="flex justify-center py-8">
        <p class="text-white">Carregando categorias...</p>
    </div>

    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
        <div 
            v-for="category in categories" :key="category.id"
            @click="router.visit(`/topicos/categoria/${category.slug}`)"
            class="p-5 bg-[#192633] rounded-xl border border-[#324D67] hover:border-primary/50 transition-all cursor-pointer group"
        >
            <div class="size-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined">forum</span>
            </div>
            <h3 class="text-white text-base font-bold group-hover:text-primary transition-colors">{{ category.name }}</h3>
            <p class="text-xs text-slate-400 mt-1">Explore discussões sobre {{ category.name.toLowerCase() }}.</p>
        </div>
    </div>
  </div>
</template>