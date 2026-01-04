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
        <div>
            <Breadcrumbs :items="breadcrumbs" />

            <div class="flex flex-col gap-4 border-b border-[#233648] pb-6 mt-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="flex flex-col gap-3 max-w-3xl">
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-black leading-tight tracking-[-0.02em] text-white">
                            Qual a melhor stack para iniciar em 2024?
                        </h1>
                        <div class="flex flex-wrap items-center gap-3 text-sm text-[#92adc9]">
                            <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                15 de Outubro, 2023
                            </span>
                            <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                            <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                1.2k visualizações
                            </span>
                            <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                            <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">chat_bubble</span>
                                42 respostas
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-6">
                <article class="flex flex-col md:flex-row gap-4 p-5 md:p-6 rounded-xl bg-[#1c2631] shadow-sm border border-[#233648] relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-0">
                        <div class="bg-primary text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg">ORIGINAL</div>
                    </div>
                    <div class="flex md:flex-col items-center md:items-start gap-3 md:w-48 shrink-0">
                        <div class="relative">
                            <div class="bg-center bg-no-repeat bg-cover rounded-full w-12 h-12 md:w-16 md:h-16 ring-2 ring-primary/20" data-alt="Profile picture of the post author" style="background-image: url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuCI55CoFN0phcboiF7TStorsyrgSLzAyU54Hao7HzHu_WBFbVtluzOi5-fR4afpWP7JVH8WAe7DVTIwPZx8hh0IAGZZIKDwBft56w90n5TDvuUVYqdc6kMUbM3-wkbHTsjQcn2pLQsbN2pGzgVUYSm0Q1zel2B24SA0Kc0FTR3yU4VpMVH4yETh3q2Kr3Cp9aiNaBW9_0NiUOqp_oIk7V8rCrsvankRmzU1K9sFKdJAWofiu1axciA0epsSRM9hWy6Ro_-1yLXnzYk&quot;);"></div>
                            <div class="absolute -bottom-1 -right-1 bg-green-500 w-3 h-3 md:w-4 md:h-4 rounded-full border-2 border-[#1c2631]"></div>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-bold text-white text-base md:text-lg">DevMaster</h3>
                            <span class="text-xs font-medium text-primary bg-primary/10 px-2 py-0.5 rounded w-fit">Iniciador</span>
                            <div class="flex md:flex-col gap-2 md:gap-0 mt-1 md:mt-2 text-xs text-gray-400">
                            <span>Posts: 45</span>
                            <span class="hidden md:inline">Membro desde 2022</span>
                            </div>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="flex flex-1 flex-col gap-4 min-w-0 justify-between">
                        <div class="prose-invert max-w-none text-gray-200 text-base leading-relaxed">
                            <p>Olá pessoal,</p>
                        </div>
                        <!-- Post Actions -->
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-[#233648]/50">
                            <div class="flex items-center gap-1">
                                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-gray-500 hover:text-white transition-colors group/btn">
                                    <span class="material-symbols-outlined text-[20px] group-hover/btn:text-primary">thumb_up</span>
                                    <span class="text-sm font-medium">15</span>
                                </button>
                                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-gray-500 hover:text-red-400 transition-colors group/btn">
                                    <span class="material-symbols-outlined text-[20px] group-hover/btn:text-red-400">thumb_down</span>
                                </button>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">reply</span>
                                    <span class="text-sm font-bold">Responder</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="flex flex-col md:flex-row gap-4 p-5 md:p-6 rounded-xl bg-[#1c2631] shadow-sm border border-[#233648]" id="post-2">
                    <div class="flex md:flex-col items-center md:items-start gap-3 md:w-48 shrink-0">
                        <div class="bg-center bg-no-repeat bg-cover rounded-full w-10 h-10 md:w-14 md:h-14 ring-1 ring-gray-700" data-alt="Profile picture of user SarahJs" style="background-image: url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuDGlVfVwsINeiiII6WLzJNEFdmDgW9yFa1ljvsC_-ENgyjk_qd_Fp2kxoO_ch1D5P25tBK1jv00CUCaj9rhvI4vWLaE8hv1LShYS2AIBA3xPZ20Ghquq9yqqOLhEWpf_C6C-LwjEWJdNGc4jOpoFUt8nCp-0cE2JMvHzGaVqW4oir6kP5jYOd3iBmMTlVhk1yspseo9KhsyZQlanNUWS4Y9rsMdHUx9DVcE8s8_r3yX2RfO_3l77xUPxBuZr2pHE_A_lb839IDfBow&quot;);"></div>
                        <div class="flex flex-col">
                            <h3 class="font-bold text-white text-sm md:text-base">SarahJs</h3>
                            <span class="text-xs font-medium text-purple-400">Senior Dev</span>
                            <div class="flex md:flex-col gap-2 md:gap-0 mt-1 md:mt-2 text-[10px] md:text-xs text-gray-400">
                            <span>2h atrás</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-1 flex-col gap-3 min-w-0 justify-between">
                        <div class="prose-invert max-w-none text-gray-300 text-sm md:text-base">
                            <p>Oi <span class="text-primary font-medium">@DevMaster</span>! Na minha opinião, </p>
                        </div>
                        <div class="mt-2 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-1">
                            <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-gray-500 hover:text-white transition-colors group/btn">
                            <span class="material-symbols-outlined text-[18px] group-hover/btn:text-primary">thumb_up</span>
                            <span class="text-xs font-medium">8</span>
                            </button>
                            </div>
                            <button class="text-xs font-bold text-gray-500 hover:text-primary transition-colors">Responder</button>
                        </div>
                    </div>
                </article>
            </div>

            <div class="mt-12 rounded-xl bg-[#1c2631] shadow-sm border border-[#233648] overflow-hidden">
                <div class="bg-[#233648]/30 px-4 py-3 border-b border-[#233648] flex items-center justify-between">
                    <span class="text-sm font-bold text-white">Responder ao tópico</span>
                </div>
                <div class="p-4">
                    <div class="flex items-center gap-1 mb-2 pb-2 border-b border-[#233648]/50">
                        <button class="p-1.5 rounded hover:bg-[#233648] text-[#92adc9] transition-colors" title="Negrito">
                        <span class="material-symbols-outlined text-[20px]">format_bold</span>
                        </button>
                        <button class="p-1.5 rounded hover:bg-[#233648] text-[#92adc9] transition-colors" title="Itálico">
                        <span class="material-symbols-outlined text-[20px]">format_italic</span>
                        </button>
                        <button class="p-1.5 rounded hover:bg-[#233648] text-[#92adc9] transition-colors" title="Link">
                        <span class="material-symbols-outlined text-[20px]">link</span>
                        </button>
                        <div class="w-px h-4 bg-gray-600 mx-1"></div>
                        <button class="p-1.5 rounded hover:bg-[#233648] text-[#92adc9] transition-colors" title="Lista">
                        <span class="material-symbols-outlined text-[20px]">format_list_bulleted</span>
                        </button>
                        <button class="p-1.5 rounded hover:bg-[#233648] text-[#92adc9] transition-colors" title="Código">
                        <span class="material-symbols-outlined text-[20px]">code</span>
                        </button>
                        <button class="p-1.5 rounded hover:bg-[#233648] text-[#92adc9] transition-colors" title="Imagem">
                        <span class="material-symbols-outlined text-[20px]">image</span>
                        </button>
                    </div>
                    <textarea class="w-full min-h-[160px] bg-transparent border-0 focus:ring-0 text-white placeholder:text-[#92adc9]/50 resize-y p-0" placeholder="Escreva sua resposta aqui... Lembre-se de ser gentil e construtivo."></textarea>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center gap-2">
                            <div class="bg-center bg-no-repeat bg-cover rounded-full w-8 h-8 opacity-75" data-alt="Current user mini avatar" style="background-image: url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuC0KUAWornByfJEamyNl0V3Aw5G8UJ5qiqg4yZJ7I_qYqWjsF4XsFYzS4YDnKNKuhXWdSrFiLGxgq45fCSSMlKeV2VGTrNNHsz2natkjfLfCzEXiRU_J9gIstGK1FlgDNZVVONbIeEXDDgc2BZBBB0KL_vwfZOtBA35ZnGRDPKv9BaKIw41M532lrEi5mUUib4QpbPXRhtiFr-mms23ozq_oBduJK7sQM9j587UL9damcbKv3H0zaezERtHTjn6Q2kCqmKMSh7U7J4&quot;);"></div>
                            <span class="text-xs text-[#92adc9]">Respondendo como <strong>Você</strong></span>
                        </div>
                        <button class="flex items-center justify-center rounded-lg bg-primary px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-600 hover:shadow-blue-500/30 transition-all active:scale-95">
                        Postar Resposta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>