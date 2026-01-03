<script setup>
import { Link } from '@inertiajs/vue3';
import banner from '@/assets/background-banner.png'
</script>

<template>
    <div 
        class="relative w-full rounded-2xl overflow-hidden bg-surface-dark border border-[#324d67]/50 shadow-x"
        :style="{ backgroundImage: `url(${banner})` }"
    >
        <div class="p-12 z-30 flex items-center gap-8 justify-between">
            <div class="flex flex-col gap-4 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/20 border border-primary/30 w-fit">
                    <span class="size-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-xs font-bold text-primary tracking-wide uppercase">Bem-vindo à comunidade</span>
                </div>
                <h2 class="text-5xl font-extrabold">
                    O lugar onde ideias se encontram.
                </h2>
                <p class="text-slate-300 text-lg">
                    Participe de discussões, tire dúvidas sobre tecnologia, design e desenvolvimento. 
                    Sua próxima grande colaboração começa aqui.
                </p>
                <div class="flex gap-3 items-center pt-2">
                    <a class="bg-white rounded-lg py-3 px-6 text-slate-900 font-bold text-sm h-11">Começar agora</a>
                    <a class="h-11 bg-[var(--background-base-card)] flex gap-2 items-center rounded-lg py-3 px-6 text-white font-bold text-sm border-sky-900 border">
                        <span class="material-symbols-outlined text-[18px]">menu_book</span>
                        Ler Regras
                    </a>
                </div>
            </div>
           <div class="hidden md:flex gap-4">
                <div class="flex flex-col items-center p-4 bg-[#233648]/40 backdrop-blur-md rounded-xl border border-[#324d67]/50 min-w-[120px]">
                    <span class="text-2xl font-black text-white">12k+</span>
                    <span class="text-xs font-medium text-text-secondary uppercase tracking-wider">Membros</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-[#233648]/40 backdrop-blur-md rounded-xl border border-[#324d67]/50 min-w-[120px]">
                    <span class="text-2xl font-black text-primary">540</span>
                    <span class="text-xs font-medium text-text-secondary uppercase tracking-wider">Online</span>
                </div>
            </div>
        </div>
    </div>
</template>