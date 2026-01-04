<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    username: String
});

const breadcrumbs = [
  { label: 'Visualizando perfil', link: '#' },
]

const user = ref(null);
const loading = ref(true);
const isOwnProfile = ref(false);
const fileInput = ref(null);

onMounted(async () => {
    try {
        // In a real app, we'd get the username from props or URL
        // For now, let's assume it's passed or we fetch a default
        const username = props.username || 'tiago'; 
        const response = await axios.get(`/api/users/${username}`);
        user.value = response.data;
        
        const loggedInUser = JSON.parse(localStorage.getItem('user'));
        if (loggedInUser && loggedInUser.username === user.value.username) {
            isOwnProfile.value = true;
        }
    } catch (error) {
        console.error('Error fetching user:', error);
    } finally {
        loading.value = false;
    }
});

const triggerAvatarUpload = () => {
    if (isOwnProfile.value) {
        fileInput.value.click();
    }
};

const handleAvatarUpload = async (event) => {
    const file = event.target.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('avatar', file);

    const token = localStorage.getItem('token');
    try {
        const response = await axios.post('/api/profile/avatar', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                Authorization: `Bearer ${token}`
            }
        });
        user.value.avatar = response.data.avatar_url;
        
        // Update stored user
        const loggedInUser = JSON.parse(localStorage.getItem('user'));
        loggedInUser.avatar = response.data.avatar_url;
        localStorage.setItem('user', JSON.stringify(loggedInUser));
    } catch (error) {
        console.error('Error uploading avatar:', error);
    }
};
</script>

<template>
    <AppLayout>
        <Breadcrumbs :items="breadcrumbs" />

        <main v-if="user" class="flex-1 w-full max-w-[960px] mx-auto px-4 py-8 flex flex-col gap-6">
            <section class="flex flex-col md:flex-row gap-6 items-start md:items-center justify-between p-6 rounded-xl bg-[#192633] shadow-sm border border-border-dark">
                <div class="flex items-center gap-5">
                    <div class="relative group">
                        <div 
                            @click="triggerAvatarUpload"
                            class="bg-center bg-no-repeat bg-cover rounded-full size-24 md:size-32 ring-4 ring-background-dark cursor-pointer overflow-hidden relative"
                            :style="{ backgroundImage: `url(${user.avatar || 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y'})` }"
                        >
                            <div v-if="isOwnProfile" class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined text-white">photo_camera</span>
                            </div>
                        </div>
                        <input type="file" ref="fileInput" class="hidden" @change="handleAvatarUpload" accept="image/*">
                        <div class="absolute bottom-1 right-1 bg-green-500 size-4 rounded-full border-2 border-surface-dark" title="Online"></div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                            <h1 class="text-2xl md:text-3xl font-bold text-white">{{ user.name }}</h1>
                            <span class="text-slate-400 text-sm">@{{ user.username }}</span>
                        </div>
                        <p class="text-slate-400 text-sm">{{ user.bio || 'Sem bio disponível.' }}</p>
                        <div class="flex items-center gap-4 mt-2 text-xs text-slate-400 dark:text-slate-500 font-medium uppercase tracking-wide">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                                Membro desde {{ new Date(user.created_at).toLocaleDateString('pt-BR', { month: 'short', year: 'numeric' }) }}
                            </span>
                            <span v-if="user.location" class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">location_on</span>
                                {{ user.location }}
                            </span>
                        </div>
                    </div>
                </div>
                <button v-if="isOwnProfile" class="w-full md:w-auto px-6 h-10 rounded-lg bg-primary hover:bg-blue-600 active:bg-blue-700 text-white font-bold text-sm transition-colors flex items-center justify-center gap-2 shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                    <span>Editar Perfil</span>
                </button>
            </section>
            
            <!-- Rest of the profile content (stats, activity) -->
            <section class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex flex-col p-5 rounded-lg bg-[#192633] border border-border-dark shadow-sm">
                    <div class="flex items-center gap-2 mb-2 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">forum</span>
                        <span class="text-sm font-medium">Postagens</span>
                    </div>
                    <p class="text-3xl font-bold text-white">0</p>
                </div>
                <div class="flex flex-col p-5 rounded-lg bg-[#192633] border border-border-dark shadow-sm">
                    <div class="flex items-center gap-2 mb-2 text-slate-400">
                        <span class="material-symbols-outlined text-[20px]">post_add</span>
                        <span class="text-sm font-medium">Tópicos</span>
                    </div>
                    <p class="text-3xl font-bold text-white">0</p>
                </div>
            </section>

            <section class="border-b border-border-dark">
                <nav aria-label="Tabs" class="flex gap-8 px-2">
                    <a class="border-b-[3px] border-primary pb-3 pt-2 text-primary text-sm font-bold flex items-center gap-2" href="#">
                        <span class="material-symbols-outlined text-[18px]">history</span>
                        Atividade Recente
                    </a>
                </nav>
            </section>

            <section class="flex flex-col gap-4">
                <p class="text-slate-400 text-center py-8">Nenhuma atividade recente encontrada.</p>
            </section>
        </main>
        <div v-else-if="loading" class="flex-1 flex items-center justify-center">
            <p class="text-white">Carregando perfil...</p>
        </div>
        <div v-else class="flex-1 flex items-center justify-center">
            <p class="text-white">Usuário não encontrado.</p>
        </div>
    </AppLayout>
</template>