<template>
  <div
    class="flex flex-col items-center max-w-[1150px] w-full min-h-[600px] h-auto m-auto mb-[50px]">
    <div class="flex w-full h-full m-auto bg-[#6f6f6f7d] grow items-center">
      <slot></slot>
    </div>
    <div class="flex justify-between w-full">
      <Button :label="label[0]" className="btn-secondary" :path="path[0]" />
      <Button v-if="!isCreateContext" :label="label[1]" className="btn-primary" :path="path[1]"/>
      <Button v-else :label="label[1]" className="btn-primary cursor-pointer" @click="handleFirstClick" />
    </div>
  </div>
</template>

<script setup>
const { label, path, isCreateContext } = defineProps(["label", "path", "isCreateContext"]);
const emit = defineEmits(["handleFirstClick"]);

const count = ref(1);

function handleFirstClick() {
  emit('handleFirstClick', count.value++);
}
</script>