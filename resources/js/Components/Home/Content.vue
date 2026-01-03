<script setup>
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mt-8">
        <div class="lg:col-span-8 flex flex-col gap-6">
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-[#324d67] pb-1">
                <div class="flex gap-6">
                    <button class="relative pb-3 text-sm font-bold text-primary">
                        Recentes
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary rounded-t-full"></span>
                    </button>
                    <button class="pb-3 text-sm font-medium text-text-secondary hover:text-white transition-colors">
                        Populares
                    </button>
                    <button class="pb-3 text-sm font-medium text-text-secondary hover:text-white transition-colors">
                        Sem resposta
                    </button>
                </div>
                <div class="flex items-center gap-2 pb-2">
                    <span class="text-xs font-medium text-text-secondary hidden sm:block">Filtrar por:</span>
                    <select class="bg-transparent text-sm font-medium text-white border-none focus:ring-0 cursor-pointer p-0 pr-6">
                        <option>Todas as tags</option>
                        <option>Resolvido</option>
                        <option>Ajuda</option>
                    </select>
                </div>
            </div>
            <div>
                <div>
                    <article class="group flex flex-col sm:flex-row gap-4 p-4 rounded-xl border border-[#324d67] bg-surface-dark hover:border-primary/40 transition-all cursor-pointer">
                        <div class="shrink-0 pt-1">
                            <div class="size-10 rounded-full bg-cover bg-center ring-2 ring-transparent group-hover:ring-primary/50 transition-all" data-alt="Author avatar" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBJU1JcJ81oYYiUVlowr9wJQ_bO7P7N7haWK9m4iKP-3S-GZjEpD3X9nvd3qKf2wNTEu3gxWYcYhJnKgtfX7p6s3ZtT-rNWiiCdWotWBFu7vEUNwQlBfoWAPfs_wtuaznqzkqvMhCjWRnNMy6H4j_WjPT2dZ_IT0ZdKkJKGj33qRp369VyJrRUNMQF4dZXdWELrb4ralvKLakvyAFd2dYcOhgI7chJt1kI_db2rbvFVNZiXHsaqtWHW3Xe580azDuCsa5BCCqMnNCI');"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex flex-col gap-1">
                                    <h3 class="text-base font-bold text-white group-hover:text-primary transition-colors line-clamp-1">
                                    Melhores práticas para otimização de React Hooks em 2024?
                                    </h3>
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-xs text-text-secondary">
                                    <span class="font-medium text-slate-300">Por Carlos Silva</span>
                                    <span class="size-1 rounded-full bg-slate-400"></span>
                                    <span>há 2 horas</span>
                                    <span class="size-1 rounded-full bg-slate-400"></span>
                                    <span class="px-2 py-0.5 rounded bg-blue-900/30 text-blue-300 font-medium">React</span>
                                    <span class="px-2 py-0.5 rounded bg-slate-700/50 text-slate-400 font-medium">Frontend</span>
                                    </div>
                                </div>
                                <div class="hidden sm:flex items-center gap-1 shrink-0">
                                    <span class="material-symbols-outlined text-green-500" :style="{fontSize: '18px'}" title="Resolvido">check_circle</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center sm:items-end gap-4 sm:gap-1 text-xs text-text-secondary border-t sm:border-t-0 border-[#324d67] pt-3 sm:pt-0 mt-2 sm:mt-0">
                            <div class="flex items-center gap-1" title="Respostas">
                                <span class="material-symbols-outlined" :style="{fontSize: '16px'}">chat_bubble</span>
                                <span class="font-bold text-slate-300">24</span>
                                <span class="sm:hidden">respostas</span>
                            </div>
                            <div class="flex items-center gap-1" title="Visualizações">
                                <span class="material-symbols-outlined" :style="{fontSize: '16px'}">visibility</span>
                                <span>1.2k</span>
                            </div>
                        </div>
                    </article>
                    <div class="mt-4 flex justify-center">
                        <button class="px-4 py-2 text-sm font-bold text-text-secondary bg-surface-dark border border-[#324d67] rounded-lg hover:bg-[#233648] transition-colors">
                            Carregar mais tópicos
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <aside class="lg:col-span-4 flex flex-col gap-6">
            <div class="p-6 rounded-xl border border-[#324d67] bg-surface-dark">
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">bar_chart</span>
                    Estatísticas do Fórum
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-text-secondary">Tópicos</span>
                        <span class="text-sm font-bold text-white">5,231</span>
                    </div>
                    <div class="w-full h-px bg-[#324d67]"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-text-secondary">Postagens</span>
                        <span class="text-sm font-bold text-white">48,902</span>
                    </div>
                    <div class="w-full h-px bg-[#324d67]"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-text-secondary">Membros</span>
                        <span class="text-sm font-bold text-white">12,504</span>
                    </div>
                </div>
            </div>

            <div class="p-6 rounded-xl border border-[#324d67] bg-surface-dark">
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-red-500">local_fire_department</span>
                    Tags em Alta
                </h3>
                <div class="flex flex-wrap gap-2">
                    <a class="px-3 py-1.5 rounded-lg bg-[#233648] text-xs font-medium text-text-secondary hover:bg-primary hover:text-white transition-colors" href="#">
                    #javascript
                    </a>
                    <a class="px-3 py-1.5 rounded-lg bg-[#233648] text-xs font-medium text-text-secondary hover:bg-primary hover:text-white transition-colors" href="#">
                    #python
                    </a>
                    <a class="px-3 py-1.5 rounded-lg bg-[#233648] text-xs font-medium text-text-secondary hover:bg-primary hover:text-white transition-colors" href="#">
                    #hardware
                    </a>
                    <a class="px-3 py-1.5 rounded-lg bg-[#233648] text-xs font-medium text-text-secondary hover:bg-primary hover:text-white transition-colors" href="#">
                    #design
                    </a>
                    <a class="px-3 py-1.5 rounded-lg bg-[#233648] text-xs font-medium text-text-secondary hover:bg-primary hover:text-white transition-colors" href="#">
                    #carreira
                    </a>
                    <a class="px-3 py-1.5 rounded-lg bg-[#233648] text-xs font-medium text-text-secondary hover:bg-primary hover:text-white transition-colors" href="#">
                    #eventos
                    </a>
                </div>
            </div>
        </aside>
    </div>
</template>