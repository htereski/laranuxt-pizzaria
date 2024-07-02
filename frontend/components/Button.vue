<template>
  <NuxtLink :to="path" :class="className" class="font">{{ label }}</NuxtLink>
</template>

<script setup>
const { label, className, path } = defineProps(["label", "className", "path"]);
</script>

<style scoped>
.font {
  font-family: "Inter";
  font-weight: 300;
}
</style>