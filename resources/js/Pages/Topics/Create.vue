<script setup>
import { ref, onMounted, reactive } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

const breadcrumbs = [
  { label: 'Tópicos', link: '/topicos' },
  { label: 'Novo Tópico', link: '#' }
]

const categories = ref([]);
const loading = ref(false);
const submitting = ref(false);
const errors = ref({});

const form = reactive({
    title: '',
    category_id: '',
    content: '',
});

onMounted(async () => {
    try {
        const response = await axios.get('/api/categories');
        categories.value = response.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
});

const submitTopic = async () => {
    submitting.value = true;
    errors.value = {};

    const token = localStorage.getItem('token');
    if (!token) {
        router.visit('/entrar');
        return;
    }

    try {
        await axios.post('/api/topics', form, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
        router.visit('/topicos');
    } catch (error) {
        if (error.response && error.response.data) {
            errors.value = error.response.data;
        } else {
            console.error('Error submitting topic:', error);
        }
    } finally {
        submitting.value = false;
    }
};
</script>

<template>
    <AppLayout>
        <Breadcrumbs :items="breadcrumbs" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-4">
            <main class="lg:col-span-2 flex flex-col gap-8">
                <div class="flex flex-col gap-3">
                    <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Criar Novo Tópico</h1>
                    <p class="text-slate-400 text-base md:text-lg font-normal leading-normal">Inicie uma discussão ou faça uma pergunta para a comunidade.</p>
                </div>
                <div class="bg-[#233648] border border-[#233648] rounded-xl p-6 md:p-8 shadow-sm">
                    <form @submit.prevent="submitTopic" class="flex flex-col gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-white text-base font-bold" for="topic-title">Título do Tópico</label>
                            <p class="text-xs text-slate-400 mb-1">Seja específico e imagine que você está fazendo uma pergunta a uma pessoa.</p>
                            <input 
                                v-model="form.title"
                                class="w-full rounded-lg border border-[#233648] bg-[#101922] text-white h-12 px-4 focus:ring-2 focus:ring-primary focus:border-primary placeholder:text-slate-400 transition-all" 
                                id="topic-title" placeholder="Ex: Como centralizar uma div usando Flexbox?" type="text" required
                            >
                            <p v-if="errors.title" class="text-red-500 text-xs">{{ errors.title[0] }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-white text-base font-bold" for="category-select">Categoria</label>
                            <div class="relative">
                                <select 
                                    v-model="form.category_id"
                                    class="w-full rounded-lg border border-[#233648] bg-[#101922] text-white h-12 px-4 pr-10 focus:ring-2 focus:ring-primary focus:border-primary appearance-none cursor-pointer transition-all" 
                                    id="category-select" required
                                >
                                    <option disabled value="">Selecione a categoria mais apropriada</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500">
                                    <span class="material-symbols-outlined">expand_more</span>
                                </div>
                            </div>
                            <p v-if="errors.category_id" class="text-red-500 text-xs">{{ errors.category_id[0] }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-white text-base font-bold" for="content-editor">Conteúdo</label>
                            <div class="w-full rounded-lg border border-[#233648] bg-[#101922] overflow-hidden focus-within:ring-2 focus-within:ring-primary focus-within:border-primary transition-all">
                                <div class="flex items-center gap-1 p-2 border-b border-[#233648] bg-[#233648]">
                                    <button class="p-1.5 rounded hover:bg-[#233648]-lighter text-slate-300 transition-colors" title="Negrito" type="button">
                                    <span class="material-symbols-outlined text-[20px]">format_bold</span>
                                    </button>
                                    <button class="p-1.5 rounded hover:bg-[#233648]-lighter text-slate-300 transition-colors" title="Itálico" type="button">
                                    <span class="material-symbols-outlined text-[20px]">format_italic</span>
                                    </button>
                                    <button class="p-1.5 rounded hover:bg-[#233648]-lighter text-slate-300 transition-colors" title="Sublinhado" type="button">
                                    <span class="material-symbols-outlined text-[20px]">format_underlined</span>
                                    </button>
                                    <div class="w-px h-5 bg-[#233648]-lighter mx-1"></div>
                                    <button class="p-1.5 rounded hover:bg-[#233648]-lighter text-slate-300 transition-colors" title="Lista" type="button">
                                    <span class="material-symbols-outlined text-[20px]">format_list_bulleted</span>
                                    </button>
                                    <button class="p-1.5 rounded hover:bg-[#233648]-lighter text-slate-300 transition-colors" title="Link" type="button">
                                    <span class="material-symbols-outlined text-[20px]">link</span>
                                    </button>
                                    <button class="p-1.5 rounded hover:bg-[#233648]-lighter text-slate-300 transition-colors" title="Código" type="button">
                                    <span class="material-symbols-outlined text-[20px]">code</span>
                                    </button>
                                    <button class="p-1.5 rounded hover:bg-[#233648]-lighter text-slate-300 transition-colors" title="Imagem" type="button">
                                    <span class="material-symbols-outlined text-[20px]">image</span>
                                    </button>
                                </div>
                                <textarea 
                                    v-model="form.content"
                                    class="w-full bg-transparent border-none focus:ring-0 p-4 min-h-[300px] text-white placeholder:text-slate-400 resize-y" 
                                    id="content-editor" placeholder="Descreva sua dúvida ou inicie a discussão com detalhes..." required
                                ></textarea>
                            </div>
                            <p v-if="errors.content" class="text-red-500 text-xs">{{ errors.content[0] }}</p>
                        </div>
                        <div class="flex flex-col-reverse sm:flex-row items-center gap-4 pt-4 mt-2 border-t border-[#233648]">
                            <button @click="router.visit('/topicos')" class="w-full sm:w-auto px-6 py-3 rounded-lg text-slate-300 font-bold hover:hover:bg-[#233648]-lighter transition-colors" type="button">
                                Cancelar
                            </button>
                            <div class="flex-1"></div>
                            <button 
                                :disabled="submitting"
                                class="w-full sm:w-auto px-8 py-3 rounded-lg bg-primary text-white font-bold hover:bg-blue-600 shadow-lg shadow-primary/25 transition-all flex items-center justify-center gap-2 disabled:opacity-50" 
                                type="submit"
                            >
                                <span v-if="!submitting" class="material-symbols-outlined text-[20px]">send</span>
                                {{ submitting ? 'Publicando...' : 'Publicar Tópico' }}
                            </button>
                        </div>
                    </form>
                </div>
            </main>
            <aside class="flex flex-col gap-6">
                <div class="bg-[#233648] border border-[#233648] rounded-xl p-6 shadow-sm sticky top-24">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">lightbulb</span>
                        </div>
                        <h3 class="text-white text-lg font-bold">Dicas de Postagem</h3>
                    </div>
                    <ul class="flex flex-col gap-4">
                        <li class="flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">check_circle</span>
                        <div class="flex flex-col gap-1">
                            <p class="text-white text-sm font-bold">Seja conciso no título</p>
                            <p class="text-slate-400 text-sm">Títulos curtos e diretos ajudam outros usuários a encontrar seu tópico.</p>
                        </div>
                        </li>
                        <li class="flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">check_circle</span>
                        <div class="flex flex-col gap-1">
                            <p class="text-white text-sm font-bold">Escolha a categoria certa</p>
                            <p class="text-slate-400 text-sm">Categorias incorretas podem fazer com que sua dúvida demore mais para ser respondida.</p>
                        </div>
                        </li>
                        <li class="flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">check_circle</span>
                        <div class="flex flex-col gap-1">
                            <p class="text-white text-sm font-bold">Use formatação</p>
                            <p class="text-slate-400 text-sm">Blocos de código e imagens tornam seu post mais legível e atrativo.</p>
                        </div>
                        </li>
                        <li class="flex gap-3 items-start">
                        <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">check_circle</span>
                        <div class="flex flex-col gap-1">
                            <p class="text-white text-sm font-bold">Pesquise antes</p>
                            <p class="text-slate-400 text-sm">Verifique se sua dúvida já não foi respondida em outro tópico.</p>
                        </div>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>

    </AppLayout>
</template>