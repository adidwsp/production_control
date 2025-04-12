<template>
  <div class="logo">
    <RouterLink to="/">
      <img :src="currentLogo" height="35px" alt="Logo" />
    </RouterLink>
  </div>
</template>
<script setup lang="ts">
import { ref, computed } from 'vue';
import { RouterLink } from 'vue-router';
import LogoDark from '@/assets/images/logos/logo.svg';
import LogoLight from '@/assets/images/logos/logoLight.svg';

const isDarkTheme = ref(false);
const currentLogo = computed(() => (isDarkTheme.value ? LogoDark : LogoLight));

const primary = ref('rgb(var(--v-theme-primary))');
const secondary = ref('rgb(var(--v-theme-secondary))');
</script>
