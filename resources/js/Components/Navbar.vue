<script setup>
import { Link } from '@inertiajs/vue3';
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
            class="block w-full rounded-lg border-0 bg-[#233648] py-1.5 pl-10 pr-3 text-white placeholder:text-text-secondary focus:ring-2 focus:ring-primary sm:text-sm sm:leading-6 transition-all outline-none" 
            placeholder="Pesquisar tópicos, perguntas, membros..." 
            type="text"
          >
        </label>
      </div>

      <nav class="hidden lg:flex items-center gap-6 xl:gap-8 mx-4">
        <Link class="text-sm font-semibold text-primary" href="/">Início</Link>
        <Link class="text-sm font-medium text-text-secondary hover:text-primary transition-colors" href="/topicos">Tópicos</Link>
        <Link class="text-sm font-medium text-text-secondary hover:text-primary transition-colors" href="#">Membros</Link>
         <Link class="text-sm font-medium text-text-secondary hover:text-primary transition-colors" href="#">Regras</Link>
      </nav>

      <div class="flex items-center gap-3 shrink-0">
        <button class="bg-primary hover:bg-primary-dark text-white px-4 h-9 flex items-center gap-2 text-sm font-bold rounded-lg transition-all">
          <span class="material-symbols-outlined text-[20px]">add</span>
          <span>Novo Tópico</span>
        </button>

        <div class="flex items-center gap-1 border-l border-border-dark pl-3 ml-1">
          <button class="p-2 text-text-secondary hover:text-white">
            <span class="material-symbols-outlined">notifications</span>
          </button>
          <button class="p-2 text-text-secondary hover:text-white">
            <span class="material-symbols-outlined">mail</span>
          </button>
        </div>

        <div class="size-9 rounded-full bg-border-dark overflow-hidden border border-border-dark">
          <img src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff" class="w-full h-full object-cover">
        </div>
      </div>

    </div>
  </header>
</template>