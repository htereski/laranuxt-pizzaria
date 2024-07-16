<template>
  <Head>
    <Title>Erro</Title>
  </Head>
  <div class="min-h-screen flex flex-col">
    <Header />
    <div class="flex-grow flex flex-col justify-center items-center bg-[#FFA920]">
      <img src="/assets/img/error.jpg" alt="error" class="md:w-1/3" />
      <p class="font text-[60px] text-center">Página não encontrada</p>
    </div>
    <Footer />
  </div>
</template>
  
<script setup>
defineProps(["error"]);
const handleClearError = () => clearError({ redirect: "/" });
</script>

<style scoped>
.font {
    font-family: "Poiret One";
}
</style>