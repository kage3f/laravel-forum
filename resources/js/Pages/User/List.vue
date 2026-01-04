<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const breadcrumbs = [
  { label: 'Membros', link: '/membros' },
]
</script>

<template>
  <AppLayout>
        <Breadcrumbs :items="breadcrumbs" />

        <div class="flex flex-1 justify-center py-5">
        <div class="w-full flex flex-col flex-1">
            <div class="flex flex-wrap justify-between items-end gap-3 mb-2">
                <div class="flex flex-col gap-2">
                    <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Membros da Comunidade</h1>
                </div>
            </div>
            <div class="mb-4 mt-6">
                <div class="flex flex-col md:flex-row gap-4 justify-between items-center rounded-xl bg-[#192633] p-4 border border-border-dark shadow-sm">
                    <div class="relative w-full md:max-w-[400px]">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#92adc9]">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </div>
                    <input class="block w-full rounded-lg border-0 bg-[#111a22] py-2.5 pl-10 pr-4 text-white placeholder-[#92adc9] focus:ring-2 focus:ring-primary sm:text-sm sm:leading-6" placeholder="Buscar por nome ou @usuario..." type="text">
                    </div>
                    <div class="flex w-full md:w-auto gap-3 overflow-x-auto pb-2 md:pb-0">
                    <div class="relative min-w-[160px]">
                        <select class="block w-full appearance-none rounded-lg border border-border-dark bg-[#111a22] py-2.5 pl-3 pr-10 text-sm text-white focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                            <option>Ordenar por: Recentes</option>
                            <option>Ordenar por: Mais Antigos</option>
                            <option>Ordenar por: Postagens</option>
                            <option>Ordenar por: Nome (A-Z)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-[#92adc9]">
                            <span class="material-symbols-outlined text-[18px]">sort</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="py-3 @container">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    <a class="relative flex flex-col items-center justify-center p-6 rounded-xl border border-border-dark bg-[#192633] shadow-sm hover:shadow-md transition-shadow group cursor-pointer" href="#">
                        <div class="relative mb-4">
                            <div class="size-20 flex-shrink-0 rounded-full bg-cover bg-center ring-2 ring-primary/50" data-alt="Foto de perfil de Carlos Silva" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD2WFIYyQ7XKQEaHbzMHbQlnLGDPGrZDr0S7pmfu1Iibipl4NAmj924D6AQ8ahnAwihcuvxoH5h_H40Xt37PzXxjM9qCL-ma_HdS3b8WmsBwHByH6WZYNuG1nMGRQWibIDfLhC0uUAgeJDpw6mKsjRc9KjVELQlKAsvn7Lj4pyK9G8Aisd4tpCRTTRJBTeZRJBDVAIe_Z_IaNY-02gvFRb69ryi7Nt9PxySIYsE-D1VgEQsHRlXJknGp-RU-GIl71cnEnJ09ThM6_I');"></div>
                        </div>
                        <div class="text-lg font-bold text-white mb-1">Carlos Silva</div>
                        <div class="text-sm text-[#92adc9] mb-3">@carlos_silva</div>
                    </a>
                </div>
            </div>
            <div class="flex items-center justify-center p-4 mt-2">
                <div class="flex items-center gap-2">
                    <a class="flex size-10 items-center justify-center rounded-lg hover:bg-black/5 dark:hover:bg-white/5 transition-colors" href="#">
                        <span class="material-symbols-outlined text-white">chevron_left</span>
                    </a>
                    <a class="text-sm font-bold leading-normal flex size-10 items-center justify-center text-white rounded-lg bg-primary shadow-sm" href="#">1</a>
                    <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-white rounded-lg hover:bg-black/5 dark:hover:bg-white/5 transition-colors" href="#">2</a>
                    <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-white rounded-lg hover:bg-black/5 dark:hover:bg-white/5 transition-colors" href="#">3</a>
                    <span class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#92adc9]">...</span>
                    <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-white rounded-lg hover:bg-black/5 dark:hover:bg-white/5 transition-colors" href="#">50</a>
                    <a class="flex size-10 items-center justify-center rounded-lg hover:bg-black/5 dark:hover:bg-white/5 transition-colors" href="#">
                    <span class="material-symbols-outlined text-white">chevron_right</span>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </AppLayout>
</template>