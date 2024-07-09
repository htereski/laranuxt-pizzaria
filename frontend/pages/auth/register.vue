<template>
  <Head>
    <Title>Registrar-se</Title>
  </Head>
  <div class="image flex justify-center">
    <div
      class="max-h-[700px] h-full max-w-[600px] w-full px-[50px] m-auto flex items-center justify-center flex-col bg-white rounded-lg gap-[36px]"
    >
      <h1 class="text-4xl font-bold font">Registrar-se</h1>
      <Input type="text" title="Nome" />
      <Input type="email" title="E-mail" />
      <Input type="password" title="Senha" />
      <Button label="AVANÇAR" className="btn-primary" path="/email/confirmation" />
      <p class="text-[13px] font font-medium">Já tem uma conta?</p>
      <Button label="ENTRAR" className="btn-secondary" path="/auth/login" />
    </div>
  </div>
</template>

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