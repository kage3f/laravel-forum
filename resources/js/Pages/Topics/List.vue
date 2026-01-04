<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const breadcrumbs = [
  { label: 'Tópicos', link: '/topicos' },
]
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
            <button class="shrink-0 flex items-center justify-center gap-2 rounded-lg h-10 px-5 bg-primary hover:bg-blue-600 text-white text-sm font-bold tracking-wide transition-all shadow-lg shadow-blue-500/20">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Criar Novo Tópico
            </button>
          </div>
          <div class="flex flex-col gap-3">
            <div class="group flex flex-col sm:flex-row gap-4 bg-[#192633] hover:bg-[#1e2c3b] border border-[#233648] hover:border-primary/30 rounded-xl p-5 transition-all cursor-pointer">
                <div class="flex items-start gap-4 flex-1">
                  <div class="text-[#fbbf24] flex items-center justify-center rounded-lg bg-[#233648] group-hover:bg-[#fbbf24]/10 shrink-0 size-12 transition-colors">
                      <span class="material-symbols-outlined text-[28px]">support_agent</span>
                  </div>
                  <div class="flex flex-col">
                      <h4 class="text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">Central de Ajuda</h4>
                      <p class="text-text-secondary text-sm mt-1 leading-relaxed">
                        Problemas com a conta? Bug no site? Abra um ticket aqui para falar com a staff.
                      </p>
                  </div>
                </div>
                <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2 sm:gap-1 pl-16 sm:pl-0 border-t sm:border-t-0 border-[#233648] pt-3 sm:pt-0 mt-2 sm:mt-0 shrink-0 min-w-[140px]">
                  <div class="flex items-center gap-1.5" title="15 Tópicos">
                      <span class="material-symbols-outlined text-text-secondary text-[16px]">topic</span>
                      <span class="text-white text-sm font-medium">15</span>
                  </div>
                  <div class="flex items-center gap-1.5 text-text-secondary text-xs">
                      <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                      <span>3d atrás</span>
                  </div>
                </div>
            </div>
          </div>
      </div>

      <aside class="lg:col-span-4 xl:col-span-3 flex flex-col gap-6">
          <div class="bg-[#192633] border border-[#233648] rounded-xl overflow-hidden">
            <div class="bg-[#233648]/50 px-5 py-3 border-b border-[#233648]">
                <h3 class="text-white text-sm font-bold">Tópicos em Alta</h3>
            </div>
            <div class="flex flex-col">
                <a class="p-4 border-b border-[#233648] hover:bg-[#233648]/50 transition-colors group" href="#">
                  <h4 class="text-white text-sm font-medium leading-snug group-hover:text-primary transition-colors line-clamp-2">
                      Como começar a programar em Python em 2024?
                  </h4>
                  <div class="flex items-center gap-2 mt-2 text-xs text-text-secondary">
                      <span class="material-symbols-outlined text-[14px]">chat_bubble</span>
                      <span>42 respostas</span>
                  </div>
                </a>
            </div>
          </div>
      </aside>
    </div>
  </AppLayout>
</template>