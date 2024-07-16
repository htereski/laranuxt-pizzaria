<template>
  <div v-if="show" class="modal-overlay" @click.self="close">
    <div class="modal-container">
      <button class="modal-close" @click="close">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="1em"
          height="1em"
          viewBox="0 0 24 24">
          <path
            fill="black"
            d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z"/>
        </svg>
      </button>
      <slot></slot>
    </div>
  </div>
</template>
  
<script setup>
const props = defineProps(["show"]);
const emit = defineEmits(["close"]);

function close() {
  emit("close");
}
</script>
  
<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-container {
  background: white;
  padding: 20px;
  border-radius: 5px;
  position: relative;
  max-width: 500px;
  min-height: 200px;
  width: 100%;
}

.modal-close {
  position: absolute;
  top: 10px;
  right: 10px;
  background: transparent;
  border: none;
  font-family: "Inter";
  font-size: 16px;
  cursor: pointer;
}
</style>