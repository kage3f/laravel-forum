<script setup>
import { ref, onMounted, watch } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import axios from 'axios';
import { router, usePage } from '@inertiajs/vue3';

const breadcrumbs = [
  { label: 'Tópicos', link: '/topicos' },
]

const topics = ref([]);
const categories = ref([]);
const loading = ref(true);

const fetchData = async () => {
    loading.value = true;
    const urlParams = new URLSearchParams(window.location.search);
    const search = urlParams.get('search');
    
    try {
        const [topicsRes, categoriesRes] = await Promise.all([
            axios.get('/api/topics', { params: { search } }),
            axios.get('/api/categories')
        ]);
        topics.value = topicsRes.data.data || [];
        categories.value = categoriesRes.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchData);

// Watch for URL changes (e.g. when searching from navbar while on topics page)
watch(() => usePage().url, fetchData);

const formatTime = (dateString) => {
    const date = new Date(dateString);
    const now = new Date();
    const diff = Math.floor((now - date) / 1000);
    
    if (diff < 60) return 'agora';
    if (diff < 3600) return `${Math.floor(diff / 60)}m atrás`;
    if (diff < 86400) return `${Math.floor(diff / 3600)}h atrás`;
    return `${Math.floor(diff / 86400)}d atrás`;
};
</script>

<template>
  <AppLayout>
    <Breadcrumbs :items="breadcrumbs" />
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-6">
      <div class="lg:col-span-8 xl:col-span-9 flex flex-col gap-6">
          <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-[#233648] pb-6">
            <div class="flex flex-col gap-2">
                <h1 class="text-white text-3xl md:text-4xl font-black tracking-tight">Tópicos</h1>
                <p class="text-text-secondary text-base max-w-2xl">
                  Navegue pelas discussões organizadas por temas de interesse. Encontre sua comunidade.
                </p>
            </div>
            <button @click="router.visit('/topicos/criar')" class="shrink-0 flex items-center justify-center gap-2 rounded-lg h-10 px-5 bg-primary hover:bg-blue-600 text-white text-sm font-bold tracking-wide transition-all shadow-lg shadow-blue-500/20">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Criar Novo Tópico
            </button>
          </div>
          
          <div v-if="loading" class="flex justify-center py-12">
              <p class="text-white">Carregando tópicos...</p>
          </div>

          <div v-else-if="topics.length > 0" class="flex flex-col gap-3">
            <div 
                v-for="topic in topics" :key="topic.id"
                @click="router.visit(`/topicos/${topic.uuid}`)"
                class="group flex flex-col sm:flex-row gap-4 bg-[#192633] hover:bg-[#1e2c3b] border border-[#233648] hover:border-primary/30 rounded-xl p-5 transition-all cursor-pointer"
            >
                <div class="flex items-start gap-4 flex-1">
                  <div class="text-primary flex items-center justify-center rounded-lg bg-[#233648] group-hover:bg-primary/10 shrink-0 size-12 transition-colors">
                      <span class="material-symbols-outlined text-[28px]">forum</span>
                  </div>
                  <div class="flex flex-col">
                      <div class="flex items-center gap-2 mb-1">
                          <span class="text-xs font-bold text-primary uppercase tracking-wider">{{ topic.category?.name }}</span>
                          <span class="text-xs text-slate-500">•</span>
                          <span class="text-xs text-slate-500">por {{ topic.user?.username }}</span>
                      </div>
                      <h4 class="text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">{{ topic.title }}</h4>
                      <p class="text-text-secondary text-sm mt-1 leading-relaxed line-clamp-2">
                        {{ topic.content }}
                      </p>
                  </div>
                </div>
                <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2 sm:gap-1 pl-16 sm:pl-0 border-t sm:border-t-0 border-[#233648] pt-3 sm:pt-0 mt-2 sm:mt-0 shrink-0 min-w-[140px]">
                  <div class="flex items-center gap-3 text-text-secondary text-xs">
                      <div class="flex items-center gap-1">
                          <span class="material-symbols-outlined text-[14px]">chat_bubble</span>
                          <span>{{ topic.comments_count || 0 }}</span>
                      </div>
                      <div class="flex items-center gap-1">
                          <span class="material-symbols-outlined text-[14px]">schedule</span>
                          <span>{{ formatTime(topic.created_at) }}</span>
                      </div>
                  </div>
                </div>
            </div>
          </div>

          <div v-else class="flex justify-center py-12">
              <p class="text-slate-400">Nenhum tópico encontrado.</p>
          </div>
      </div>

      <aside class="lg:col-span-4 xl:col-span-3 flex flex-col gap-6">
          <div class="bg-[#192633] border border-[#233648] rounded-xl overflow-hidden">
            <div class="bg-[#233648]/50 px-5 py-3 border-b border-[#233648]">
                <h3 class="text-white text-sm font-bold">Categorias</h3>
            </div>
            <div class="flex flex-col">
                <div 
                    v-for="category in categories" :key="category.id"
                    @click="router.visit(`/topicos/categoria/${category.slug}`)"
                    class="p-4 border-b border-[#233648] hover:bg-[#233648]/50 transition-colors group flex justify-between items-center cursor-pointer" 
                >
                  <span class="text-white text-sm font-medium group-hover:text-primary transition-colors">{{ category.name }}</span>
                  <span class="material-symbols-outlined text-slate-500 text-[18px]">chevron_right</span>
                </div>
            </div>
          </div>
      </aside>
    </div>
  </AppLayout>
</template>