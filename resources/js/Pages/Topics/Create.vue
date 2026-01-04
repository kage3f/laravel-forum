<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const breadcrumbs = [
  { label: 'Tópicos', link: '/topicos' },
  { label: 'Novo Tópico', link: '#' }
]
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
                    <form action="#" class="flex flex-col gap-6" onsubmit="event.preventDefault();">
                        <div class="flex flex-col gap-2">
                        <label class="text-white text-base font-bold" for="topic-title">Título do Tópico</label>
                        <p class="text-xs text-slate-400 mb-1">Seja específico e imagine que você está fazendo uma pergunta a uma pessoa.</p>
                        <input class="w-full rounded-lg border border-[#233648] bg-[#101922] text-white h-12 px-4 focus:ring-2 focus:ring-primary focus:border-primary placeholder:text-slate-400 transition-all" id="topic-title" placeholder="Ex: Como centralizar uma div usando Flexbox?" type="text">
                        </div>
                        <div class="flex flex-col gap-2">
                        <label class="text-white text-base font-bold" for="category-select">Categoria</label>
                        <div class="relative">
                            <select class="w-full rounded-lg border border-[#233648] bg-[#101922] text-white h-12 px-4 pr-10 focus:ring-2 focus:ring-primary focus:border-primary appearance-none cursor-pointer transition-all" id="category-select">
                                <option disabled="" selected="" value="">Selecione a categoria mais apropriada</option>
                                <option value="dev">Desenvolvimento Web</option>
                                <option value="design">UI/UX Design</option>
                                <option value="devops">DevOps &amp; Cloud</option>
                                <option value="career">Carreira</option>
                                <option value="offtopic">Off-topic</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-500">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </div>
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
                            <textarea class="w-full bg-transparent border-none focus:ring-0 p-4 min-h-[300px] text-white placeholder:text-slate-400 resize-y" id="content-editor" placeholder="Descreva sua dúvida ou inicie a discussão com detalhes..."></textarea>
                        </div>
                        </div>
                        <div class="flex flex-col gap-2">
                        <label class="text-white text-base font-bold" for="tags-input">Tags (Opcional)</label>
                        <div class="w-full rounded-lg border border-[#233648] bg-[#101922] min-h-[48px] px-2 py-1.5 flex flex-wrap gap-2 items-center focus-within:ring-2 focus-within:ring-primary focus-within:border-primary transition-all">
                            <span class="bg-primary/20 text-primary px-2 py-1 rounded text-sm font-medium flex items-center gap-1">
                            css
                            <button class="hover:text-white hover:bg-primary rounded-full p-0.5 transition-colors" type="button">
                            <span class="material-symbols-outlined text-[14px]">close</span>
                            </button>
                            </span>
                            <span class="bg-primary/20 text-primary px-2 py-1 rounded text-sm font-medium flex items-center gap-1">
                            frontend
                            <button class="hover:text-white hover:bg-primary rounded-full p-0.5 transition-colors" type="button">
                            <span class="material-symbols-outlined text-[14px]">close</span>
                            </button>
                            </span>
                            <input class="flex-1 min-w-[120px] bg-transparent border-none focus:ring-0 text-white placeholder:text-slate-400 h-8" id="tags-input" placeholder="Adicione até 5 tags..." type="text">
                        </div>
                        </div>
                        <div class="flex flex-col-reverse sm:flex-row items-center gap-4 pt-4 mt-2 border-t border-[#233648]">
                        <button class="w-full sm:w-auto px-6 py-3 rounded-lg text-slate-300 font-bold hover:hover:bg-[#233648]-lighter transition-colors" type="button">
                        Cancelar
                        </button>
                        <div class="flex-1"></div>
                        <button class="w-full sm:w-auto px-8 py-3 rounded-lg bg-primary text-white font-bold hover:bg-blue-600 shadow-lg shadow-primary/25 transition-all flex items-center justify-center gap-2" type="submit">
                        <span class="material-symbols-outlined text-[20px]">send</span>
                        Publicar Tópico
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
                    <div class="mt-6 pt-4 border-t border-[#233648]">
                        <a class="text-primary text-sm font-medium hover:underline flex items-center gap-1" href="#">
                        Ver regras da comunidade
                        <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                        </a>
                    </div>
                </div>
            </aside>
        </div>

    </AppLayout>
</template>