<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const breadcrumbs = [
  { label: 'Visualizando perfil', link: '#' },
]
</script>

<template>
    <AppLayout>
        <Breadcrumbs :items="breadcrumbs" />

        <main class="flex-1 w-full max-w-[960px] mx-auto px-4 py-8 flex flex-col gap-6">
            <section class="flex flex-col md:flex-row gap-6 items-start md:items-center justify-between p-6 rounded-xl bg-[#192633] shadow-sm border border-border-dark">
                <div class="flex items-center gap-5">
                    <div class="relative">
                        <div class="bg-center bg-no-repeat bg-cover rounded-full size-24 md:size-32 ring-4 ring-background-dark" data-alt="Foto de perfil do usuário Alex_Dev" style="background-image: url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuBLXbNT1U-uDrHAibkCEgXm_LWqvFIDmS5bsjhR1jsjTO5HNPd9HR3BdHUG6yXiF51t6LCXzffmb_46OPhEs2JtascT_6162bi65u3j5T3bM0_8npZZ_6IPBBI7oWwZA7NevY_dAztnBEW1wymbSSMUEUzRiUUESunTYrNcSmR4528svPMlx-ZF-8DO8x7b0zn1gaHL_SyBuSB3XBwAzXYNptjFFO0gmB6LcIFGL3EKD8YMmxFN3F6G-t_E6ApgsDezCMqwVPs31G4&quot;);"></div>
                        <div class="absolute bottom-1 right-1 bg-green-500 size-4 rounded-full border-2 border-surface-dark" title="Online"></div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Alex_Dev</h1>
                        <span class="px-2 py-0.5 rounded-full bg-primary/20 text-primary text-xs font-bold border border-primary/20">PRO</span>
                        </div>
                        <p class="text-slate-400 text-sm">Full Stack Developer | Open Source Enthusiast</p>
                        <div class="flex items-center gap-4 mt-2 text-xs text-slate-400 dark:text-slate-500 font-medium uppercase tracking-wide">
                        <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                        Membro desde Jan 2023
                        </span>
                        <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                        São Paulo, BR
                        </span>
                        </div>
                    </div>
                </div>
                <button class="w-full md:w-auto px-6 h-10 rounded-lg bg-primary hover:bg-blue-600 active:bg-blue-700 text-white font-bold text-sm transition-colors flex items-center justify-center gap-2 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Editar Perfil</span>
                </button>
            </section>
            <section class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex flex-col p-5 rounded-lg bg-[#192633] border border-border-dark shadow-sm">
                    <div class="flex items-center gap-2 mb-2 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">forum</span>
                        <span class="text-sm font-medium">Postagens</span>
                    </div>
                    <p class="text-3xl font-bold text-white">142</p>
                </div>
                <div class="flex flex-col p-5 rounded-lg bg-[#192633] border border-border-dark shadow-sm">
                    <div class="flex items-center gap-2 mb-2 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">post_add</span>
                        <span class="text-sm font-medium">Tópicos</span>
                    </div>
                    <p class="text-3xl font-bold text-white">56</p>
                </div>
                <div class="flex flex-col p-5 rounded-lg bg-[#192633] border border-border-dark shadow-sm">
                    <div class="flex items-center gap-2 mb-2 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">favorite</span>
                        <span class="text-sm font-medium">Curtidas</span>
                    </div>
                    <p class="text-3xl font-bold text-white">1.2k</p>
                </div>
            </section>
            <section class="border-b border-border-dark">
                <nav aria-label="Tabs" class="flex gap-8 px-2">
                    <a class="border-b-[3px] border-primary pb-3 pt-2 text-primary text-sm font-bold flex items-center gap-2" href="#">
                    <span class="material-symbols-outlined text-[18px]">history</span>
                    Atividade Recente
                    </a>
                    <a class="border-b-[3px] border-transparent pb-3 pt-2 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 text-sm font-bold flex items-center gap-2 transition-colors" href="#">
                    <span class="material-symbols-outlined text-[18px]">person</span>
                    Sobre
                    </a>
                </nav>
            </section>
            <section class="flex flex-col gap-4">
                <article class="group flex gap-4 p-5 rounded-lg bg-[#192633] border border-border-dark hover:border-primary/50 dark:hover:border-primary/50 transition-all shadow-sm">
                    <div class="hidden sm:block shrink-0">
                        <div class="bg-center bg-no-repeat bg-cover rounded-lg size-[72px]" data-alt="Imagem ilustrativa de código React" style="background-image: url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuCmPHk5KjG_QuSz-vIl41jDjz_Zr4YQp-WL38zHL79Nl7p1wfblD2PCIm8bIGEcT-d-8GnMBOeAmcy9x25c0IhYNCH5SNBwawLImWh_QYZYfrKcfETLie8QbpuTJw7YfowIyabRZ_GKsKeB99jEtVQcU7yeArEhg5fHzMl-kmAmYkD0cpn980ZiVFegq2naN2N96HlqeePY9Kuo2sBgKxJsErqhyUmE3trajHIgao7jSwxDW_AfRW9GLJMygIc_DVDveCX2ZGi5vqE&quot;);"></div>
                    </div>
                    <div class="flex flex-col flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-semibold text-primary uppercase tracking-wider">Desenvolvimento Web</span>
                        <span class="text-xs text-slate-400 dark:text-slate-500 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">schedule</span> 2 horas atrás
                        </span>
                        </div>
                        <h3 class="text-lg font-bold text-white truncate group-hover:text-primary transition-colors cursor-pointer">
                        Como configurar o React Router v6 com TypeScript?
                        </h3>
                        <p class="text-slate-400 text-sm mt-1 line-clamp-2 leading-relaxed">
                        Estou tendo dificuldades com as novas APIs de data router. Alguém já implementou a função loader com tipagem estrita no novo padrão?
                        </p>
                        <div class="flex items-center gap-4 mt-3">
                        <div class="flex items-center gap-1 text-xs text-slate-400">
                            <span class="material-symbols-outlined text-[16px]">thumb_up</span>
                            12
                        </div>
                        <div class="flex items-center gap-1 text-xs text-slate-400">
                            <span class="material-symbols-outlined text-[16px]">chat_bubble</span>
                            4 Respostas
                        </div>
                        </div>
                    </div>
                </article>
            </section>
        </main>
    </AppLayout>
</template>