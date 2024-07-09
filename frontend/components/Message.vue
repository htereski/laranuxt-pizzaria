<template>
  <div class="m-auto max-w-[1100px] font" :class="type === 'success' ? 'bg-[#1B8D18]' : 'bg-[#E3170A]'">
    <p class="text-white text-center p-2">{{ msg }}</p>
  </div>
</template>

<script setup>
const { msg } = defineProps(["msg", "type"]);
</script>

<style scoped>
.font {
  font-family: "Inter";
}
</style>