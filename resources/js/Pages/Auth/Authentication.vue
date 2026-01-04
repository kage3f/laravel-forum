<script setup>

</script>

<template>
    <div class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-display overflow-x-hidden text-white group/design-root">
        <div class="layout-container flex h-full grow flex-col w-full">
            <div class="flex flex-1 justify-center py-5 sm:py-10 px-4">
                <div class="layout-content-container flex flex-col w-full max-w-[480px] flex-1">
                    <div class="text-center pb-6 pt-2">
                    <h1 class="text-white tracking-light text-[32px] font-bold leading-tight px-4">Bem-vindo de volta</h1>
                    <p class="text-text-secondary text-base font-normal mt-2">Acesse sua conta para participar das discussões.</p>
                    </div>
                    <div class="pb-6">
                    <div class="flex border-b border-border-dark justify-between">
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-b-primary text-white pb-[13px] pt-4 flex-1 cursor-pointer transition-colors hover:bg-surface-dark/30 rounded-t-lg" href="#">
                            <p class="text-white text-sm font-bold leading-normal tracking-[0.015em]">Entrar</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-text-secondary pb-[13px] pt-4 flex-1 cursor-pointer transition-colors hover:text-white hover:bg-surface-dark/30 rounded-t-lg" href="#">
                            <p class="text-text-secondary text-sm font-bold leading-normal tracking-[0.015em]">Cadastrar</p>
                        </a>
                    </div>
                    </div>
                    <form class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <label class="text-white text-base font-medium leading-normal" for="email">E-mail ou Nome de usuário</label>
                        <input class="form-input flex w-full resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-dark bg-surface-dark focus:border-primary h-14 placeholder:text-text-secondary p-[15px] text-base font-normal leading-normal transition-all" id="email" placeholder="exemplo@email.com" type="text" value="">
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center">
                            <label class="text-white text-base font-medium leading-normal" for="password">Senha</label>
                        </div>
                        <div class="flex w-full items-stretch rounded-lg group focus-within:ring-2 focus-within:ring-primary/50">
                            <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l-lg text-white focus:outline-0 focus:ring-0 border border-border-dark bg-surface-dark focus:border-primary h-14 placeholder:text-text-secondary p-[15px] border-r-0 text-base font-normal leading-normal transition-all" id="password" placeholder="Insira sua senha" type="password" value="">
                            <button class="text-text-secondary flex border border-border-dark bg-surface-dark items-center justify-center px-[15px] rounded-r-lg border-l-0 hover:text-white transition-colors focus:border-primary focus:border-l" type="button">
                            <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </div>
                        <div class="flex justify-end mt-1">
                            <a class="text-primary text-sm font-bold hover:text-primary/80 transition-colors" href="#">Esqueceu sua senha?</a>
                        </div>
                    </div>
                    <div class="pt-4">
                        <button class="w-full h-12 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                        <span>Entrar</span>
                        <span class="material-symbols-outlined text-xl">login</span>
                        </button>
                    </div>
                    </form>
                    <div class="mt-8 text-center">
                    <p class="text-xs text-text-secondary leading-relaxed">
                        Ao continuar, você concorda com nossos <br>
                        <a class="text-primary hover:underline" href="#">Termos de Serviço</a> e <a class="text-primary hover:underline" href="#">Política de Privacidade</a>.
                    </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 opacity-20" data-alt="Abstract blue radial gradient at the top center to create a glow effect" style="background: radial-gradient(circle at 50% 0%, #2b8cee 0%, transparent 40%);"></div>
    </div>
</template>