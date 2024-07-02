<template>
  <div class="image flex justify-center">
    <div
      class="max-h-[700px] h-full max-w-[600px] w-full px-[50px] m-auto flex items-center justify-center flex-col bg-white rounded-lg gap-[36px]"
    >
      <h1 class="text-4xl font-bold font">Nova senha</h1>
      <Input type="password" title="Senha" />
      <Input type="password" title="Confirmar senha" />
      <Button
        label="AVANÇAR"
        className="btn-primary"
        path=""
        @click="showModal = true"
      />
      <Modal :show="showModal" @close="showModal = false" >
        <p>Senha alterada com sucesso!</p>
      </Modal>
    </div>
  </div>
</template>

<script setup>
const showModal = ref(false);
</script>
  
<style scoped>
.image {
  position: relative;
  height: 100vh;
}

.image::before {
  content: "";
  background-image: url("../../assets/img/login.jpg");
  background-size: cover;
  filter: brightness(50%);
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: -1;
}

.font {
  font-family: "Inter";
}
</style>
