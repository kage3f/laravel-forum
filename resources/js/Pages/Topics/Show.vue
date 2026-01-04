<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    slug: String
});

const topics = ref([]);
const category = ref(null);
const loading = ref(true);
const breadcrumbs = ref([
  { label: 'Tópicos', link: '/topicos' },
]);

onMounted(async () => {
    try {
        // For now, we don't have a specific category endpoint that returns topics
        // So we fetch all topics and filter them, or just fetch all for now
        // Ideally: axios.get(`/api/categories/${props.slug}/topics`)
        const [topicsRes, categoriesRes] = await Promise.all([
            axios.get('/api/topics'),
            axios.get('/api/categories')
        ]);
        
        // Find category by slug (simulated)
        const cat = categoriesRes.data.find(c => c.slug === props.slug);
        const allTopics = topicsRes.data.data || [];
        if (cat) {
            category.value = cat;
            topics.value = allTopics.filter(t => t.category_id === cat.id);
            breadcrumbs.value.push({ label: cat.name });
        } else {
            topics.value = allTopics;
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    } finally {
        loading.value = false;
    }
});

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
        <div class="flex w-full flex-col gap-8 lg:flex-row">  
            <div class="flex flex-1 flex-col gap-6 min-w-0">
                <Breadcrumbs :items="breadcrumbs" />
                
                <div v-if="category" class="flex flex-col gap-6 border-b border-[#192633] pb-8 md:flex-row md:items-center md:justify-between">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-3xl font-black tracking-tight text-white md:text-4xl">{{ category.name }}</h1>
                        <p class="max-w-2xl text-text-secondary">
                            Explore discussões sobre {{ category.name.toLowerCase() }}.
                        </p>
                    </div>
                    <button @click="router.visit('/topicos/criar')" class="flex shrink-0 items-center justify-center gap-2 rounded-lg bg-primary px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/25 transition-all hover:bg-blue-500">
                        <span class="material-symbols-outlined text-[20px]">add</span>
                        <span>Novo Tópico</span>
                    </button>
                </div>

                <div v-if="loading" class="flex justify-center py-12">
                    <p class="text-white">Carregando tópicos...</p>
                </div>

                <div v-else-if="topics.length > 0" class="flex flex-col overflow-hidden rounded-xl border border-[#233648] bg-[#192633]">
                    <div 
                        v-for="topic in topics" :key="topic.id"
                        @click="router.visit(`/topicos/${topic.uuid}`)"
                        class="group relative grid grid-cols-1 items-center gap-4 border-b border-[#233648] px-6 py-4 transition-colors hover:bg-primary/5 md:grid-cols-12 cursor-pointer"
                    >
                        <div class="col-span-1 md:col-span-8 flex gap-4">
                            <div class="flex flex-col gap-1">
                                <h4 class="text-lg font-bold text-white group-hover:text-primary transition-colors">{{ topic.title }}</h4>
                                <div class="flex items-center gap-2 text-sm text-text-secondary">
                                    <span>por {{ topic.user?.username }}</span>
                                    <span>•</span>
                                    <span>{{ formatTime(topic.created_at) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-4 flex justify-end">
                            <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
                        </div>
                    </div>
                </div>
                
                <div v-else class="flex justify-center py-12">
                    <p class="text-slate-400">Nenhum tópico encontrado nesta categoria.</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>