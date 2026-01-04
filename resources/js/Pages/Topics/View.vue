<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import axios from 'axios';

const props = defineProps({
    uuid: String
});

const topic = ref(null);
const loading = ref(true);
const breadcrumbs = ref([
  { label: 'Tópicos', link: '/topicos' },
]);

onMounted(async () => {
    try {
        const response = await axios.get(`/api/topics/${props.uuid}`);
        topic.value = response.data;
        breadcrumbs.value.push({ label: topic.value.category?.name || 'Tópico' });
    } catch (error) {
        console.error('Error fetching topic:', error);
    } finally {
        loading.value = false;
    }
});

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });
};
</script>

<template>
    <AppLayout>
        <div v-if="topic">
            <Breadcrumbs :items="breadcrumbs" />

            <div class="flex flex-col gap-4 border-b border-[#233648] pb-6 mt-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="flex flex-col gap-3 max-w-3xl">
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-black leading-tight tracking-[-0.02em] text-white">
                            {{ topic.title }}
                        </h1>
                        <div class="flex flex-wrap items-center gap-3 text-sm text-[#92adc9]">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                {{ formatDate(topic.created_at) }}
                            </span>
                            <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                0 visualizações
                            </span>
                            <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">chat_bubble</span>
                                0 respostas
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-6 mt-6">
                <article class="flex flex-col md:flex-row gap-4 p-5 md:p-6 rounded-xl bg-[#1c2631] shadow-sm border border-[#233648] relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-0">
                        <div class="bg-primary text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg">ORIGINAL</div>
                    </div>
                    <div class="flex md:flex-col items-center md:items-start gap-3 md:w-48 shrink-0">
                        <div class="relative">
                            <div 
                                class="bg-center bg-no-repeat bg-cover rounded-full w-12 h-12 md:w-16 md:h-16 ring-2 ring-primary/20" 
                                :style="{ backgroundImage: `url(${topic.user?.avatar || `https://ui-avatars.com/api/?name=${topic.user?.name}&background=0D8ABC&color=fff`})` }"
                            ></div>
                            <div class="absolute -bottom-1 -right-1 bg-green-500 w-3 h-3 md:w-4 md:h-4 rounded-full border-2 border-[#1c2631]"></div>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-bold text-white text-base md:text-lg">{{ topic.user?.name }}</h3>
                            <span class="text-xs font-medium text-primary bg-primary/10 px-2 py-0.5 rounded w-fit">Iniciador</span>
                            <div class="flex md:flex-col gap-2 md:gap-0 mt-1 md:mt-2 text-xs text-gray-400">
                                <span>@{{ topic.user?.username }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="flex flex-1 flex-col gap-4 min-w-0 justify-between">
                        <div class="prose prose-invert max-w-none text-gray-200 text-base leading-relaxed">
                            <p>{{ topic.content }}</p>
                        </div>
                        <!-- Post Actions -->
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-[#233648]/50">
                            <div class="flex items-center gap-1">
                                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-gray-500 hover:text-white transition-colors group/btn">
                                    <span class="material-symbols-outlined text-[20px] group-hover/btn:text-primary">thumb_up</span>
                                    <span class="text-sm font-medium">0</span>
                                </button>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">reply</span>
                                    <span class="text-sm font-bold">Responder</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <div class="mt-12 rounded-xl bg-[#1c2631] shadow-sm border border-[#233648] overflow-hidden">
                <div class="bg-[#233648]/30 px-4 py-3 border-b border-[#233648] flex items-center justify-between">
                    <span class="text-sm font-bold text-white">Responder ao tópico</span>
                </div>
                <div class="p-4">
                    <textarea class="w-full min-h-[160px] bg-transparent border-0 focus:ring-0 text-white placeholder:text-[#92adc9]/50 resize-y p-0" placeholder="Escreva sua resposta aqui... Lembre-se de ser gentil e construtivo."></textarea>
                    <div class="flex items-center justify-between mt-4">
                        <button class="flex items-center justify-center rounded-lg bg-primary px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-600 hover:shadow-blue-500/30 transition-all active:scale-95">
                            Postar Resposta
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-else-if="loading" class="flex justify-center py-12">
            <p class="text-white">Carregando tópico...</p>
        </div>
        <div v-else class="flex justify-center py-12">
            <p class="text-white">Tópico não encontrado.</p>
        </div>
    </AppLayout>
</template>