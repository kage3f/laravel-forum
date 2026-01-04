<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import axios from 'axios';
import { Link } from '@inertiajs/vue3';

const breadcrumbs = [
  { label: 'Membros', link: '/membros' },
]

const users = ref([]);
const loading = ref(true);

onMounted(async () => {
    try {
        const response = await axios.get('/api/users');
        users.value = response.data.data || [];
    } catch (error) {
        console.error('Error fetching users:', error);
    } finally {
        loading.value = false;
    }
});
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
                </div>
            </div>
            
            <div v-if="loading" class="flex justify-center py-12">
                <p class="text-white">Carregando membros...</p>
            </div>

            <div v-else class="py-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    <Link 
                        v-for="user in users" :key="user.id"
                        :href="`/user/${user.username}`"
                        class="relative flex flex-col items-center justify-center p-6 rounded-xl border border-border-dark bg-[#192633] shadow-sm hover:shadow-md transition-shadow group cursor-pointer"
                    >
                        <div class="relative mb-4">
                            <div 
                                class="size-20 flex-shrink-0 rounded-full bg-cover bg-center ring-2 ring-primary/50" 
                                :style="{ backgroundImage: `url(${user.avatar || `https://ui-avatars.com/api/?name=${user.name}&background=0D8ABC&color=fff`})` }"
                            ></div>
                        </div>
                        <div class="text-lg font-bold text-white mb-1">{{ user.name }}</div>
                        <div class="text-sm text-[#92adc9] mb-3">@{{ user.username }}</div>
                    </Link>
                </div>
            </div>
        </div>
        </div>
    </AppLayout>
</template>