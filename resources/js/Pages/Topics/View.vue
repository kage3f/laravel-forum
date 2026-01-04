<script setup>
import { ref, onMounted, reactive } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import axios from 'axios';

const props = defineProps({
    uuid: String
});

const topic = ref(null);
const comments = ref([]);
const loading = ref(true);
const submitting = ref(false);
const breadcrumbs = ref([
  { label: 'Tópicos', link: '/topicos' },
]);

const commentForm = reactive({
    content: ''
});

const fetchData = async () => {
    try {
        const [topicRes, commentsRes] = await Promise.all([
            axios.get(`/api/topics/${props.uuid}`),
            axios.get(`/api/topics/${props.uuid}/comments`)
        ]);
        topic.value = topicRes.data;
        comments.value = commentsRes.data;
        
        if (breadcrumbs.value.length === 1) {
            breadcrumbs.value.push({ label: topic.value.category?.name || 'Tópico' });
        }
    } catch (error) {
        console.error('Error fetching topic data:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchData);

const submitComment = async () => {
    if (!commentForm.content.trim()) return;
    
    submitting.value = true;
    const token = localStorage.getItem('token');
    
    try {
        const response = await axios.post(`/api/topics/${props.uuid}/comments`, commentForm, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
        comments.value.unshift(response.data);
        commentForm.content = '';
    } catch (error) {
        console.error('Error posting comment:', error);
        if (error.response?.status === 401) {
            alert('Você precisa estar logado para comentar.');
        }
    } finally {
        submitting.value = false;
    }
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
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
                                <span class="material-symbols-outlined text-[18px]">chat_bubble</span>
                                {{ comments.length }} respostas
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-6 mt-6">
                <!-- Original Post -->
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
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-bold text-white text-base md:text-lg">{{ topic.user?.name }}</h3>
                            <span class="text-xs font-medium text-primary bg-primary/10 px-2 py-0.5 rounded w-fit">Iniciador</span>
                            <div class="flex md:flex-col gap-2 md:gap-0 mt-1 md:mt-2 text-xs text-gray-400">
                                <span>@{{ topic.user?.username }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-1 flex-col gap-4 min-w-0 justify-between">
                        <div class="prose prose-invert max-w-none text-gray-200 text-base leading-relaxed">
                            <p>{{ topic.content }}</p>
                        </div>
                    </div>
                </article>

                <!-- Comments -->
                <article 
                    v-for="comment in comments" :key="comment.id"
                    class="flex flex-col md:flex-row gap-4 p-5 md:p-6 rounded-xl bg-[#1c2631] shadow-sm border border-[#233648]"
                >
                    <div class="flex md:flex-col items-center md:items-start gap-3 md:w-48 shrink-0">
                        <div 
                            class="bg-center bg-no-repeat bg-cover rounded-full w-10 h-10 md:w-14 md:h-14 ring-1 ring-gray-700" 
                            :style="{ backgroundImage: `url(${comment.user?.avatar || `https://ui-avatars.com/api/?name=${comment.user?.name}&background=0D8ABC&color=fff`})` }"
                        ></div>
                        <div class="flex flex-col">
                            <h3 class="font-bold text-white text-sm md:text-base">{{ comment.user?.name }}</h3>
                            <div class="text-[10px] md:text-xs text-gray-400">
                                <span>@{{ comment.user?.username }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-1 flex-col gap-3 min-w-0 justify-between">
                        <div class="prose prose-invert max-w-none text-gray-300 text-sm md:text-base">
                            <p>{{ comment.content }}</p>
                        </div>
                        <div class="mt-2 text-xs text-gray-500">
                            {{ formatDate(comment.created_at) }}
                        </div>
                    </div>
                </article>
            </div>

            <!-- Reply Form -->
            <div class="mt-12 rounded-xl bg-[#1c2631] shadow-sm border border-[#233648] overflow-hidden">
                <div class="bg-[#233648]/30 px-4 py-3 border-b border-[#233648] flex items-center justify-between">
                    <span class="text-sm font-bold text-white">Responder ao tópico</span>
                </div>
                <div class="p-4">
                    <textarea 
                        v-model="commentForm.content"
                        class="w-full min-h-[160px] bg-transparent border-0 focus:ring-0 text-white placeholder:text-[#92adc9]/50 resize-y p-0" 
                        placeholder="Escreva sua resposta aqui... Lembre-se de ser gentil e construtivo."
                    ></textarea>
                    <div class="flex items-center justify-between mt-4">
                        <button 
                            @click="submitComment"
                            :disabled="submitting"
                            class="flex items-center justify-center rounded-lg bg-primary px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-600 hover:shadow-blue-500/30 transition-all active:scale-95 disabled:opacity-50"
                        >
                            {{ submitting ? 'Postando...' : 'Postar Resposta' }}
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