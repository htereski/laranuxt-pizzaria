<template>
  <Head>
    <Title>Cadastrar</Title>
  </Head>
  <AdminHeader />
  <Section title="Produto" />
  <Create @teste="teste" />
  <Modal :show="showModal" @close="showModal = false">
    <div class="flex w-full h-[150px] justify-center items-center">
      <p>Produto cadastrado com sucesso!</p>
    </div>
  </Modal>
  <Footer />
</template>

<script setup>
const showModal = ref(false);

function teste(data) {
  showModal.value = data;
}
</script>