<template>
  <div
    class="flex flex-col items-center max-w-[1150px] w-full min-h-[600px] h-auto m-auto mb-[50px]"
  >
    <div class="flex w-full h-full m-auto bg-[#D9D9D9] grow items-center">
      <slot></slot>
    </div>
    <div class="flex justify-between w-full">
      <Button :label="label[0]" className="btn-secondary" :path="path[0]" />
      <Button :label="label[1]" className="btn-primary" :path="path[1]" />
    </div>
  </div>
</template>

<script setup>
const { label, path } = defineProps(["label", "path"]);
</script>
