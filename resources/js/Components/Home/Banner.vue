<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import banner from '@/assets/background-banner.png'
import axios from 'axios';

const stats = ref(null);

onMounted(async () => {
    try {
        const response = await axios.get('/api/stats');
        stats.value = response.data;
    } catch (error) {
        console.error('Error fetching stats:', error);
    }
});
</script>

<template>
    <div 
        class="relative w-full rounded-2xl overflow-hidden bg-surface-dark border border-[#324d67]/50 shadow-x"
        :style="{ backgroundImage: `url(${banner})` }"
    >
        <div class="p-12 z-30 flex items-center gap-8 justify-between relative">
            <div class="flex flex-col gap-4 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/20 border border-primary/30 w-fit">
                    <span class="size-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-xs font-bold text-primary tracking-wide uppercase">Bem-vindo à comunidade</span>
                </div>
                <h2 class="text-5xl font-extrabold text-white">
                    O lugar onde ideias se encontram.
                </h2>
                <p class="text-slate-300 text-lg">
                    Participe de discussões, tire dúvidas sobre tecnologia, design e desenvolvimento. 
                    Sua próxima grande colaboração começa aqui.
                </p>
                <div class="flex gap-3 items-center pt-2">
                    <Link href="/topicos" class="bg-white rounded-lg py-3 px-6 text-slate-900 font-bold text-sm h-11 flex items-center">Começar agora</Link>
                    <Link href="#" class="h-11 bg-[#233648]/60 backdrop-blur-sm flex gap-2 items-center rounded-lg py-3 px-6 text-white font-bold text-sm border-sky-900 border">
                        <span class="material-symbols-outlined text-[18px]">menu_book</span>
                        Ler Regras
                    </Link>
                </div>
            </div>
           <div class="hidden md:flex gap-4">
                <div class="flex flex-col items-center p-4 bg-[#233648]/40 backdrop-blur-md rounded-xl border border-[#324d67]/50 min-w-[120px]">
                    <span class="text-2xl font-black text-white">{{ stats ? stats.users_count : '...' }}</span>
                    <span class="text-xs font-medium text-text-secondary uppercase tracking-wider">Membros</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-[#233648]/40 backdrop-blur-md rounded-xl border border-[#324d67]/50 min-w-[120px]">
                    <span class="text-2xl font-black text-primary">{{ stats ? stats.topics_count : '...' }}</span>
                    <span class="text-xs font-medium text-text-secondary uppercase tracking-wider">Tópicos</span>
                </div>
            </div>
        </div>
    </div>
</template>