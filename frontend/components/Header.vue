<template>
  <div
    class="background h-[100px] px-[20px] sm:px-[80px] flex items-center justify-between"
  >
    <NuxtLink to="/">
      <h1 class="logo">Laranuxt</h1>
    </NuxtLink>
    <nav class="flex gap-4 sm:gap-10 text-xs">
      <template v-for="link in links" :key="link.id">
        <NuxtLink :to="link.path">
          <p class="text-white">{{ link.title }}</p>
        </NuxtLink>
      </template>
    </nav>
  </div>
</template>
  
<script setup>
const { links } = defineProps(["links"]);
</script>
  
<style scoped>
.logo {
  color: #fff;
  font-size: 24px;
  font-family: "Inter", sans-serif;
}
</style>
