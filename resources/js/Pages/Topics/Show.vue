<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const breadcrumbs = [
  { label: 'Tópicos', link: '/topicos' },
  { label: 'Desenvolvimento Web'}
]
</script>

<template>
    <AppLayout>
        <div class="flex w-full flex-col gap-8 lg:flex-row">  
            <div class="flex flex-1 flex-col gap-6 min-w-0">
            <Breadcrumbs :items="breadcrumbs" />
            <div class="flex flex-col gap-6 border-b border-[#192633] pb-8 md:flex-row md:items-center md:justify-between">
                <div class="flex flex-col gap-2">
                    <h1 class="text-3xl font-black tracking-tight text-white md:text-4xl">Desenvolvimento Web</h1>
                    <p class="max-w-2xl text-text-secondary">
                        Espaço dedicado para discutir HTML, CSS, JavaScript, frameworks modernos e boas práticas de desenvolvimento front-end e back-end.
                    </p>
                </div>
                <button class="flex shrink-0 items-center justify-center gap-2 rounded-lg bg-primary px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/25 transition-all hover:bg-blue-500 hover:shadow-primary/50">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Novo Tópico</span>
                </button>
            </div>
            <div class="flex flex-col gap-4 rounded-xl bg-[#192633] p-2 sm:flex-row sm:items-center sm:justify-between border border-[#233648]">
                <div class="flex gap-1 overflow-x-auto pb-2 sm:pb-0 scrollbar-hide">
                </div>
                <div class="relative min-w-[200px]">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[18px]">filter_list</span>
                    <select class="w-full appearance-none rounded-lg bg-background-dark py-2 pl-10 pr-8 text-sm text-white ring-1 ring-white/10 focus:outline-none focus:ring-primary">
                        <option>Todas as tags</option>
                        <option>JavaScript</option>
                        <option>CSS</option>
                        <option>React</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary pointer-events-none text-[18px]">arrow_drop_down</span>
                </div>
            </div>
            <div class="flex flex-col overflow-hidden rounded-xl border border-[#233648] bg-[#192633]">
                <div class="hidden grid-cols-12 gap-4 border-b border-[#233648] bg-[#15202b] px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-secondary md:grid">
                    <div class="col-span-6">Tópico</div>
                    <div class="col-span-2 text-center">Estatísticas</div>
                    <div class="col-span-4 text-right">Última Atividade</div>
                </div>
                <div class="group relative grid grid-cols-1 items-center gap-4 border-b border-[#233648] bg-primary/5 px-6 py-4 transition-colors hover:bg-primary/10 md:grid-cols-12">
                    <div class="col-span-1 md:col-span-6 flex gap-4">
                        <div class="flex flex-col gap-1">
                        <a class="text-lg font-bold text-white hover:text-primary hover:underline decoration-2 underline-offset-2 transition-all" href="#">
                        Regras de Convivência e Boas Práticas
                        </a>
                        <div class="flex flex-wrap items-center gap-2 text-sm text-text-secondary">
                            <div class="flex items-center gap-1.5 rounded-full bg-primary/20 px-2.5 py-0.5 text-xs font-bold text-primary">
                                Oficial
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-start gap-6 text-sm text-text-secondary md:col-span-2 md:justify-center md:gap-8">
                        <div class="flex items-center gap-1" title="Respostas">
                        <span class="material-symbols-outlined text-lg">chat_bubble</span>
                        <span>42</span>
                        </div>
                        <div class="flex items-center gap-1" title="Visualizações">
                        <span class="material-symbols-outlined text-lg">visibility</span>
                        <span>5.2k</span>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-start gap-3 md:col-span-4 md:justify-end">
                        <div class="text-right hidden md:block">
                        <div class="text-sm font-medium text-white">há 2 dias</div>
                        <div class="text-xs text-text-secondary">por <span class="text-white">AdminSystem</span></div>
                        </div>
                        <img alt="Avatar" class="size-9 rounded-full ring-2 ring-background-dark" data-alt="Avatar do usuário Admin" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBaE009ZQoGYc_j7vx81Ctr-Ra9CWyYYaTL9MAKJeRuymet4UNbBb0N_lWwQ4QyLxSn1Fyywi-YQ0GG3J7e2m4aujzQdc8DlV_YmIy7qpTH87mN6_v-93VqoloxkTrrsaQHgBrQ9kWQ-Kyz0-spaNKss3E_jTjyamdhSyMPhceZT702jqSX_s9h3i2fALNek3aP18VPA0GYOapDTSU_c7OJtApcsM38gqV3vcxeg9qL1prAx-X6fOASg1_9xL6TptpcIbz53NGnKYE">
                        <div class="text-left md:hidden">
                        <div class="text-sm font-medium text-white">há 2 dias</div>
                        <div class="text-xs text-text-secondary">por <span class="text-white">AdminSystem</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4 items-center justify-between py-4 sm:flex-row">
                <span class="text-sm text-text-secondary">Mostrando <span class="font-bold text-white">1-5</span> de <span class="font-bold text-white">124</span> tópicos</span>
                <div class="flex rounded-lg bg-[#192633] p-1 shadow-sm ring-1 ring-white/10">
                    <button class="flex size-9 items-center justify-center rounded bg-transparent text-text-secondary hover:bg-white/5 hover:text-white disabled:opacity-50">
                    <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button class="flex size-9 items-center justify-center rounded bg-primary text-sm font-bold text-white shadow-sm">1</button>
                    <button class="flex size-9 items-center justify-center rounded bg-transparent text-sm font-medium text-text-secondary hover:bg-white/5 hover:text-white">2</button>
                    <button class="flex size-9 items-center justify-center rounded bg-transparent text-sm font-medium text-text-secondary hover:bg-white/5 hover:text-white">3</button>
                    <span class="flex size-9 items-center justify-center text-text-secondary">...</span>
                    <button class="flex size-9 items-center justify-center rounded bg-transparent text-sm font-medium text-text-secondary hover:bg-white/5 hover:text-white">25</button>
                    <button class="flex size-9 items-center justify-center rounded bg-transparent text-text-secondary hover:bg-white/5 hover:text-white">
                    <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
            </div>

            <aside class="flex w-full flex-col gap-6 lg:w-80 shrink-0">
                <div class="rounded-xl border border-[#233648] bg-[#192633] p-5">
                    <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-text-secondary">Estatísticas</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col rounded-lg bg-page-bg p-3 text-center">
                            <span class="text-xl font-black text-white">1,240</span>
                            <span class="text-xs text-text-secondary">Tópicos</span>
                        </div>
                        <div class="flex flex-col rounded-lg bg-page-bg p-3 text-center">
                            <span class="text-xl font-black text-white">8.5k</span>
                            <span class="text-xs text-text-secondary">Posts</span>
                        </div>
                    </div>
                </div>
                <div class="rounded-xl border border-[#233648] bg-[#192633] p-5">
                    <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-text-secondary">Tags Populares</h3>
                    <div class="flex flex-wrap gap-2">
                        <a class="rounded-full bg-white/5 px-3 py-1 text-xs font-medium text-text-secondary hover:bg-primary/20 hover:text-primary transition-colors" href="#">JavaScript</a>
                        <a class="rounded-full bg-white/5 px-3 py-1 text-xs font-medium text-text-secondary hover:bg-primary/20 hover:text-primary transition-colors" href="#">React</a>
                        <a class="rounded-full bg-white/5 px-3 py-1 text-xs font-medium text-text-secondary hover:bg-primary/20 hover:text-primary transition-colors" href="#">CSS Grid</a>
                        <a class="rounded-full bg-white/5 px-3 py-1 text-xs font-medium text-text-secondary hover:bg-primary/20 hover:text-primary transition-colors" href="#">Tailwind</a>
                        <a class="rounded-full bg-white/5 px-3 py-1 text-xs font-medium text-text-secondary hover:bg-primary/20 hover:text-primary transition-colors" href="#">Node.js</a>
                    </div>
                </div>
            </aside>
        </div>
    </AppLayout>
</template>