<template>
  <div
    class="max-w-[1350px] flex items-center sm:gap-[70px] gap-4 m-auto px-4 my-[50px]"
  >
    <div
      class="h-[60px] bg-black text-white flex justify-center items-center min-w-[250px] text-4xl font"
    >
      {{ title }}
    </div>
    <span class="bg-black w-[500px] h-[1px] grow"></span>
  </div>
</template>

<script setup>
const { title } = defineProps(["title"]);
</script>

<style scoped>
.font {
  font-family: "Poiret One";
}

@media (width <= 769px) {
  .font {
    font-size: 28px;
  }
}
</style>
