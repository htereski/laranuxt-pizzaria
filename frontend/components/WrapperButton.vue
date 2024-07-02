<template>
  <div :class="color" class="max-w-[1200px] min-h-[400px] m-auto mb-[50px]">
      <div class="flex flex-wrap justify-center">
        <slot></slot>
      </div>
  </div>
</template>

<script setup>
const { color } = defineProps(["color"]);
</script>