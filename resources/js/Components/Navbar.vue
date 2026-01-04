<script setup>
import { Link, usePage, router } from '@inertiajs/vue3';
import { computed, ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';

const page = usePage();
const user = ref(JSON.parse(localStorage.getItem('user')));
const searchQuery = ref('');
const isDropdownOpen = ref(false);

const isActive = (path) => {
  return page.url === path || page.url.startsWith(path + '/');
};

const handleSearch = () => {
    if (searchQuery.value.trim()) {
        router.visit(`/topicos?search=${encodeURIComponent(searchQuery.value.trim())}`);
    }
};

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const closeDropdown = (e) => {
    if (!e.target.closest('.user-dropdown-container')) {
        isDropdownOpen.value = false;
    }
};

const logout = async () => {
    try {
        await axios.post('/api/auth/logout');
    } catch (error) {
        console.error('Logout error:', error);
    } finally {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        user.value = null;
        isDropdownOpen.value = false;
        router.visit('/');
    }
};

onMounted(() => {
    window.addEventListener('click', closeDropdown);
    // Listen for storage changes to update user
    window.addEventListener('storage', () => {
        user.value = JSON.parse(localStorage.getItem('user'));
    });
});

onUnmounted(() => {
    window.removeEventListener('click', closeDropdown);
});
</script>

<template>
  <header class="sticky top-0 z-50 w-full border-b border-border-dark bg-[#192633] shadow-sm">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-10 h-16 flex items-center justify-between gap-4">
      
      <div class="flex items-center flex-1 gap-4 lg:gap-8">
        <Link class="flex items-center gap-3 text-white shrink-0 group" href="/">
          <div class="size-9 bg-primary/10 rounded-lg flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
            <span class="material-symbols-outlined">forum</span>
          </div>
          <h1 class="text-lg font-bold tracking-tight hidden sm:block">Fórum Comunidade</h1>
        </Link>

        <label class="hidden md:flex relative w-full max-w-sm h-10 group/search">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-text-secondary group-focus-within/search:text-primary transition-colors">
            <span class="material-symbols-outlined text-[20px]">search</span>
          </div>
          <input 
            v-model="searchQuery"
            @keyup.enter="handleSearch"
            class="block w-full rounded-lg border-0 bg-[#233648] py-1.5 pl-10 pr-3 text-white placeholder:text-text-secondary focus:ring-2 focus:ring-primary sm:text-sm sm:leading-6 transition-all outline-none" 
            placeholder="Pesquisar tópicos, perguntas, membros..." 
            type="text"
          >
        </label>
      </div>

      <nav class="hidden lg:flex items-center gap-6 xl:gap-8 mx-4">
        <Link 
            :class="[
                'text-sm font-semibold transition-colors',
                page.url === '/' ? 'text-primary' : 'text-text-secondary hover:text-primary'
            ]" 
            href="/"
        >Início</Link>
        <Link 
            :class="[
                'text-sm font-semibold transition-colors',
                isActive('/topicos') ? 'text-primary' : 'text-text-secondary hover:text-primary'
            ]" 
            href="/topicos"
        >Tópicos</Link>
        <Link 
            :class="[
                'text-sm font-semibold transition-colors',
                isActive('/membros') ? 'text-primary' : 'text-text-secondary hover:text-primary'
            ]" 
            href="/membros"
        >Membros</Link>
      </nav>

      <div class="flex items-center gap-3 shrink-0">
        <Link 
            href="/topicos/criar"
            class="bg-primary hover:bg-primary-dark text-white px-4 h-9 flex items-center gap-2 text-sm font-bold rounded-lg transition-all"
        >
          <span class="material-symbols-outlined text-[20px]">add</span>
          <span>Novo Tópico</span>
        </Link>

        <div v-if="user" class="flex items-center gap-3 ml-2 relative user-dropdown-container">
            <div class="flex items-center gap-1 border-l border-border-dark pl-3">
                <button class="p-2 text-text-secondary hover:text-white">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
            </div>

            <button 
                @click="toggleDropdown"
                class="size-9 rounded-full bg-border-dark overflow-hidden border border-border-dark hover:border-primary transition-all"
            >
                <img :src="user.avatar || `https://ui-avatars.com/api/?name=${user.name}&background=0D8ABC&color=fff`" class="w-full h-full object-cover">
            </button>

            <!-- Dropdown Menu -->
            <div 
                v-if="isDropdownOpen"
                class="absolute right-0 top-full mt-2 w-48 bg-[#1e2c3b] border border-[#233648] rounded-xl shadow-2xl py-2 z-[60] animate-in fade-in slide-in-from-top-2 duration-200"
            >
                <div class="px-4 py-2 border-b border-[#233648] mb-1">
                    <p class="text-white text-sm font-bold truncate">{{ user.name }}</p>
                    <p class="text-text-secondary text-xs truncate">@{{ user.username }}</p>
                </div>
                
                <Link 
                    :href="`/user/${user.username}`"
                    class="flex items-center gap-2 px-4 py-2 text-sm text-text-secondary hover:text-white hover:bg-[#233648] transition-colors"
                    @click="isDropdownOpen = false"
                >
                    <span class="material-symbols-outlined text-[18px]">person</span>
                    Meu Perfil
                </Link>
                
                <button 
                    @click="logout"
                    class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-400 hover:text-red-300 hover:bg-[#233648] transition-colors"
                >
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    Sair
                </button>
            </div>
        </div>
        <div v-else class="flex items-center gap-3 ml-2 border-l border-border-dark pl-3">
            <Link href="/entrar" class="text-sm font-bold text-white hover:text-primary transition-colors">Entrar</Link>
        </div>
      </div>

    </div>
  </header>
</template>