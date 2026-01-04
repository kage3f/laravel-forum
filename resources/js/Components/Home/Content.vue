<script setup>
import { ref, onMounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import axios from 'axios';

const topics = ref([]);
const stats = ref(null);
const categories = ref([]);
const loading = ref(true);
const activeTab = ref('recentes');

const fetchData = async () => {
    loading.value = true;
    try {
        const [topicsRes, statsRes, categoriesRes] = await Promise.all([
            axios.get('/api/topics'),
            axios.get('/api/stats'),
            axios.get('/api/categories')
        ]);
        topics.value = topicsRes.data.data;
        stats.value = statsRes.data;
        categories.value = categoriesRes.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchData);

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
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mt-8">
        <div class="lg:col-span-8 flex flex-col gap-6">
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-[#324d67] pb-1">
                <div class="flex gap-6">
                    <button 
                        @click="activeTab = 'recentes'"
                        :class="[
                            'relative pb-3 text-sm font-bold transition-colors',
                            activeTab === 'recentes' ? 'text-primary' : 'text-text-secondary hover:text-white'
                        ]"
                    >
                        Recentes
                        <span v-if="activeTab === 'recentes'" class="absolute bottom-0 left-0 w-full h-0.5 bg-primary rounded-t-full"></span>
                    </button>
                    <button 
                        @click="activeTab = 'populares'"
                        :class="[
                            'relative pb-3 text-sm font-bold transition-colors',
                            activeTab === 'populares' ? 'text-primary' : 'text-text-secondary hover:text-white'
                        ]"
                    >
                        Populares
                        <span v-if="activeTab === 'populares'" class="absolute bottom-0 left-0 w-full h-0.5 bg-primary rounded-t-full"></span>
                    </button>
                </div>
                <div class="flex items-center gap-2 pb-2">
                    <span class="text-xs font-medium text-text-secondary hidden sm:block">Filtrar por:</span>
                    <select class="bg-transparent text-sm font-medium text-white border-none focus:ring-0 cursor-pointer p-0 pr-6">
                        <option value="">Todas as categorias</option>
                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                    </select>
                </div>
            </div>
            
            <div v-if="loading" class="flex justify-center py-12">
                <p class="text-white">Carregando tópicos...</p>
            </div>

            <div v-else-if="topics.length > 0" class="flex flex-col gap-4">
                <article 
                    v-for="topic in topics" :key="topic.id"
                    @click="router.visit(`/topicos/${topic.uuid}`)"
                    class="group flex flex-col sm:flex-row gap-4 p-4 rounded-xl border border-[#324d67] bg-surface-dark hover:border-primary/40 transition-all cursor-pointer"
                >
                    <div class="shrink-0 pt-1">
                        <div 
                            class="size-10 rounded-full bg-cover bg-center ring-2 ring-transparent group-hover:ring-primary/50 transition-all" 
                            :style="{ backgroundImage: `url(${topic.user?.avatar || `https://ui-avatars.com/api/?name=${topic.user?.name}&background=0D8ABC&color=fff`})` }"
                        ></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h3 class="text-base font-bold text-white group-hover:text-primary transition-colors line-clamp-1">
                                    {{ topic.title }}
                                </h3>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-xs text-text-secondary">
                                    <span class="font-medium text-slate-300">Por {{ topic.user?.name }}</span>
                                    <span class="size-1 rounded-full bg-slate-400"></span>
                                    <span>{{ formatTime(topic.created_at) }}</span>
                                    <span class="size-1 rounded-full bg-slate-400"></span>
                                    <span class="px-2 py-0.5 rounded bg-primary/20 text-primary font-medium">{{ topic.category?.name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex sm:flex-col items-center sm:items-end gap-4 sm:gap-1 text-xs text-text-secondary border-t sm:border-t-0 border-[#324d67] pt-3 sm:pt-0 mt-2 sm:mt-0">
                        <div class="flex items-center gap-1" title="Respostas">
                            <span class="material-symbols-outlined" :style="{fontSize: '16px'}">chat_bubble</span>
                            <span class="font-bold text-slate-300">0</span>
                        </div>
                        <div class="flex items-center gap-1" title="Visualizações">
                            <span class="material-symbols-outlined" :style="{fontSize: '16px'}">visibility</span>
                            <span>0</span>
                        </div>
                    </div>
                </article>
                
                <div class="mt-4 flex justify-center">
                    <button @click="router.visit('/topicos')" class="px-4 py-2 text-sm font-bold text-text-secondary bg-surface-dark border border-[#324d67] rounded-lg hover:bg-[#233648] transition-colors">
                        Ver todos os tópicos
                    </button>
                </div>
            </div>
            <div v-else class="flex justify-center py-12">
                <p class="text-slate-400">Nenhum tópico encontrado.</p>
            </div>
        </div>

        <aside class="lg:col-span-4 flex flex-col gap-6">
            <div class="p-6 rounded-xl border border-[#324d67] bg-surface-dark">
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">bar_chart</span>
                    Estatísticas do Fórum
                </h3>
                <div v-if="stats" class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-text-secondary">Tópicos</span>
                        <span class="text-sm font-bold text-white">{{ stats.topics_count }}</span>
                    </div>
                    <div class="w-full h-px bg-[#324d67]"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-text-secondary">Membros</span>
                        <span class="text-sm font-bold text-white">{{ stats.users_count }}</span>
                    </div>
                    <div class="w-full h-px bg-[#324d67]"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-text-secondary">Categorias</span>
                        <span class="text-sm font-bold text-white">{{ stats.categories_count }}</span>
                    </div>
                </div>
                <div v-else class="text-slate-400 text-sm">Carregando estatísticas...</div>
            </div>

            <div class="p-6 rounded-xl border border-[#324d67] bg-surface-dark">
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-red-500">local_fire_department</span>
                    Categorias Populares
                </h3>
                <div class="flex flex-wrap gap-2">
                    <Link 
                        v-for="cat in categories" :key="cat.id"
                        class="px-3 py-1.5 rounded-lg bg-[#233648] text-xs font-medium text-text-secondary hover:bg-primary hover:text-white transition-colors" 
                        href="/topicos"
                    >
                        #{{ cat.slug }}
                    </Link>
                </div>
            </div>
        </aside>
    </div>
</template>