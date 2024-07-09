<template>
  <Head>
    <Title>Confirmar E-mail</Title>
  </Head>
  <div class="image flex justify-center">
    <div
      class="max-h-[700px] h-full max-w-[600px] w-full px-[50px] m-auto flex items-center justify-center flex-col bg-white rounded-lg gap-[36px]"
    >
      <h1 class="text-4xl font-bold font text-center">Confirme seu E-mail!</h1>
      <p class="text-[13px] font font-medium">E-mail não chegou?</p>
      <Button
        label="ENVIAR NOVAMENTE"
        className="btn-primary"
        path="/auth/register"
      />
    </div>
  </div>
</template>
  
<script setup>
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
  