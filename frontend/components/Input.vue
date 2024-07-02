<template>
  <input
    class="pl-2 bg-[#D9D9D9] h-[45px] text-xs w-full max-w-[500px] font"
    :type="type"
    :placeholder="title"
    required
  />
</template>

<script setup>
const props = defineProps(["type", "title"]);
</script>

<style scoped>
::placeholder {
  color: #6f6f6f;
  font-weight: bold;
  font-family: "Inter";
}

.font {
  font-family: "Inter";
}
</style>
