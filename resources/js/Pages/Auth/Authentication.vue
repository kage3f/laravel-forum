<script setup>
import { ref, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const isLogin = ref(true);
const showPassword = ref(false);
const loading = ref(false);
const errors = ref({});

const form = reactive({
    name: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const toggleMode = (mode) => {
    isLogin.value = mode === 'login';
    errors.value = {};
};

const handleSubmit = async () => {
    loading.value = true;
    errors.value = {};
    
    const url = isLogin.value ? '/api/auth/login' : '/api/auth/register';
    const payload = isLogin.value 
        ? { email: form.email, password: form.password }
        : form;

    try {
        const response = await axios.post(url, payload);
        const { access_token, user } = response.data;
        
        // Store token in localStorage
        localStorage.setItem('token', access_token);
        localStorage.setItem('user', JSON.stringify(user));
        
        // Redirect to home or dashboard
        router.visit('/');
    } catch (error) {
        if (error.response && error.response.data) {
            errors.value = error.response.data;
        } else {
            console.error('An error occurred:', error);
        }
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-display overflow-x-hidden text-white group/design-root">
        <div class="layout-container flex h-full grow flex-col w-full">
            <div class="flex flex-1 justify-center py-5 sm:py-10 px-4">
                <div class="layout-content-container flex flex-col w-full max-w-[480px] flex-1">
                    <div class="text-center pb-6 pt-2">
                        <h1 class="text-white tracking-light text-[32px] font-bold leading-tight px-4">
                            {{ isLogin ? 'Bem-vindo de volta' : 'Crie sua conta' }}
                        </h1>
                        <p class="text-text-secondary text-base font-normal mt-2">
                            {{ isLogin ? 'Acesse sua conta para participar das discussões.' : 'Junte-se à nossa comunidade hoje mesmo.' }}
                        </p>
                    </div>
                    <div class="pb-6">
                        <div class="flex border-b border-border-dark justify-between">
                            <button 
                                @click="toggleMode('login')"
                                :class="[
                                    'flex flex-col items-center justify-center border-b-[3px] pb-[13px] pt-4 flex-1 cursor-pointer transition-colors hover:bg-surface-dark/30 rounded-t-lg',
                                    isLogin ? 'border-b-primary text-white' : 'border-b-transparent text-text-secondary'
                                ]"
                            >
                                <p class="text-sm font-bold leading-normal tracking-[0.015em]">Entrar</p>
                            </button>
                            <button 
                                @click="toggleMode('register')"
                                :class="[
                                    'flex flex-col items-center justify-center border-b-[3px] pb-[13px] pt-4 flex-1 cursor-pointer transition-colors hover:bg-surface-dark/30 rounded-t-lg',
                                    !isLogin ? 'border-b-primary text-white' : 'border-b-transparent text-text-secondary'
                                ]"
                            >
                                <p class="text-sm font-bold leading-normal tracking-[0.015em]">Cadastrar</p>
                            </button>
                        </div>
                    </div>
                    <form @submit.prevent="handleSubmit" class="flex flex-col gap-4">
                        <div v-if="!isLogin" class="flex flex-col gap-2">
                            <label class="text-white text-base font-medium leading-normal" for="name">Nome Completo</label>
                            <input 
                                v-model="form.name"
                                class="form-input flex w-full resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-dark bg-surface-dark focus:border-primary h-14 placeholder:text-text-secondary p-[15px] text-base font-normal leading-normal transition-all" 
                                id="name" placeholder="Seu nome" type="text" required
                            >
                            <p v-if="errors.name" class="text-red-500 text-xs">{{ errors.name[0] }}</p>
                        </div>
                        
                        <div v-if="!isLogin" class="flex flex-col gap-2">
                            <label class="text-white text-base font-medium leading-normal" for="username">Nome de usuário</label>
                            <input 
                                v-model="form.username"
                                class="form-input flex w-full resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-dark bg-surface-dark focus:border-primary h-14 placeholder:text-text-secondary p-[15px] text-base font-normal leading-normal transition-all" 
                                id="username" placeholder="@usuario" type="text" required
                            >
                            <p v-if="errors.username" class="text-red-500 text-xs">{{ errors.username[0] }}</p>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-white text-base font-medium leading-normal" for="email">
                                {{ isLogin ? 'E-mail ou Nome de usuário' : 'E-mail' }}
                            </label>
                            <input 
                                v-model="form.email"
                                class="form-input flex w-full resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-dark bg-surface-dark focus:border-primary h-14 placeholder:text-text-secondary p-[15px] text-base font-normal leading-normal transition-all" 
                                id="email" :placeholder="isLogin ? 'exemplo@email.com ou usuario' : 'exemplo@email.com'" type="text" required
                            >
                            <p v-if="errors.email" class="text-red-500 text-xs">{{ errors.email[0] }}</p>
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="flex justify-between items-center">
                                <label class="text-white text-base font-medium leading-normal" for="password">Senha</label>
                            </div>
                            <div class="flex w-full items-stretch rounded-lg group focus-within:ring-2 focus-within:ring-primary/50">
                                <input 
                                    v-model="form.password"
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l-lg text-white focus:outline-0 focus:ring-0 border border-border-dark bg-surface-dark focus:border-primary h-14 placeholder:text-text-secondary p-[15px] border-r-0 text-base font-normal leading-normal transition-all" 
                                    id="password" placeholder="Insira sua senha" :type="showPassword ? 'text' : 'password'" required
                                >
                                <button 
                                    @click="showPassword = !showPassword"
                                    class="text-text-secondary flex border border-border-dark bg-surface-dark items-center justify-center px-[15px] rounded-r-lg border-l-0 hover:text-white transition-colors focus:border-primary focus:border-l" 
                                    type="button"
                                >
                                    <span class="material-symbols-outlined">{{ showPassword ? 'visibility_off' : 'visibility' }}</span>
                                </button>
                            </div>
                            <p v-if="errors.password" class="text-red-500 text-xs">{{ errors.password[0] }}</p>
                            <div v-if="isLogin" class="flex justify-end mt-1">
                                <a class="text-primary text-sm font-bold hover:text-primary/80 transition-colors" href="#">Esqueceu sua senha?</a>
                            </div>
                        </div>

                        <div v-if="!isLogin" class="flex flex-col gap-2">
                            <label class="text-white text-base font-medium leading-normal" for="password_confirmation">Confirmar Senha</label>
                            <input 
                                v-model="form.password_confirmation"
                                class="form-input flex w-full resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-dark bg-surface-dark focus:border-primary h-14 placeholder:text-text-secondary p-[15px] text-base font-normal leading-normal transition-all" 
                                id="password_confirmation" placeholder="Repita sua senha" type="password" required
                            >
                        </div>

                        <div class="pt-4">
                            <button 
                                :disabled="loading"
                                class="w-full h-12 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2 disabled:opacity-50"
                            >
                                <span>{{ loading ? 'Processando...' : (isLogin ? 'Entrar' : 'Cadastrar') }}</span>
                                <span v-if="!loading" class="material-symbols-outlined text-xl">{{ isLogin ? 'login' : 'person_add' }}</span>
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