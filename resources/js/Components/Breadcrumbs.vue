<script setup>
import { computed } from 'vue';

const props = defineProps({
  items: {
    type: Array,
    required: true
  }
})

const itemsBreadcrumbs = computed(() => {
    return [
        { label: 'Home', link: '/' },
        ...props.items
    ]
})

</script>

<template>
  <nav class="breadcrumb">
    <ul class="flex gap-2">
      <li v-for="(item, index) in itemsBreadcrumbs" :key="index" class="flex gap-2">
        <span v-if="item.link">
          <a :href="item.link" class="text-sm font-medium" :class="index === 0 ? 'text-slate-400' : 'text-white'">{{ item.label }}</a>
        </span>

        <span v-else>
          {{ item.label }}
        </span>

        <span v-if="index < itemsBreadcrumbs.length - 1" class="text-slate-400">
          /
        </span>
      </li>
    </ul>
  </nav>
</template>