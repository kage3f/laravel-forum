<script setup>
import { ref, onMounted, reactive } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import axios from 'axios';

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
const showEditModal = ref(false);
const saving = ref(false);

const editForm = reactive({
    name: '',
    bio: '',
    location: ''
});

const fetchData = async () => {
    try {
        const username = props.username; 
        const response = await axios.get(`/api/users/${username}`);
        user.value = response.data;
        
        const loggedInUser = JSON.parse(localStorage.getItem('user'));
        if (loggedInUser && loggedInUser.username === user.value.username) {
            isOwnProfile.value = true;
            editForm.name = user.value.name;
            editForm.bio = user.value.bio || '';
            editForm.location = user.value.location || '';
        }
    } catch (error) {
        console.error('Error fetching user:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchData);

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
        
        // Trigger navbar update
        window.dispatchEvent(new Event('storage'));
    } catch (error) {
        console.error('Error uploading avatar:', error);
        alert('Erro ao carregar avatar. Verifique o tamanho e formato.');
    }
};

const saveProfile = async () => {
    saving.value = true;
    const token = localStorage.getItem('token');
    try {
        const response = await axios.put('/api/profile', editForm, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
        user.value = response.data;
        
        // Update stored user
        const loggedInUser = JSON.parse(localStorage.getItem('user'));
        Object.assign(loggedInUser, response.data);
        localStorage.setItem('user', JSON.stringify(loggedInUser));
        
        showEditModal.value = false;
        window.dispatchEvent(new Event('storage'));
    } catch (error) {
        console.error('Error saving profile:', error);
        alert('Erro ao salvar perfil.');
    } finally {
        saving.value = false;
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
                            :style="{ backgroundImage: `url(${user.avatar || `https://ui-avatars.com/api/?name=${user.name}&background=0D8ABC&color=fff`})` }"
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
                <button 
                    v-if="isOwnProfile" 
                    @click="showEditModal = true"
                    class="w-full md:w-auto px-6 h-10 rounded-lg bg-primary hover:bg-blue-600 active:bg-blue-700 text-white font-bold text-sm transition-colors flex items-center justify-center gap-2 shadow-lg shadow-primary/20"
                >
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
        </main>

        <!-- Edit Profile Modal -->
        <div v-if="showEditModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
            <div class="bg-[#192633] border border-border-dark rounded-2xl w-full max-w-md overflow-hidden shadow-2xl">
                <div class="p-6 border-b border-border-dark flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white">Editar Perfil</h2>
                    <button @click="showEditModal = false" class="text-slate-400 hover:text-white">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="p-6 flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-bold text-slate-300">Nome</label>
                        <input v-model="editForm.name" type="text" class="bg-[#111a22] border-border-dark rounded-lg text-white focus:ring-primary focus:border-primary">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-bold text-slate-300">Bio</label>
                        <textarea v-model="editForm.bio" rows="3" class="bg-[#111a22] border-border-dark rounded-lg text-white focus:ring-primary focus:border-primary resize-none"></textarea>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-bold text-slate-300">Localização</label>
                        <input v-model="editForm.location" type="text" class="bg-[#111a22] border-border-dark rounded-lg text-white focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div class="p-6 bg-[#111a22] flex gap-3">
                    <button @click="showEditModal = false" class="flex-1 h-11 rounded-lg border border-border-dark text-white font-bold hover:bg-white/5 transition-colors">Cancelar</button>
                    <button 
                        @click="saveProfile" 
                        :disabled="saving"
                        class="flex-1 h-11 rounded-lg bg-primary text-white font-bold hover:bg-blue-600 transition-colors disabled:opacity-50"
                    >
                        {{ saving ? 'Salvando...' : 'Salvar' }}
                    </button>
                </div>
            </div>
        </div>

        <div v-else-if="loading" class="flex-1 flex items-center justify-center">
            <p class="text-white">Carregando perfil...</p>
        </div>
    </AppLayout>
</template>