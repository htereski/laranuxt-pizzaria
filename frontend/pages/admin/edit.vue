<template>
  <Head>
    <Title>Editar</Title>
  </Head>
  <AdminHeader />
  <Section title="Produto" />
  <Edit @teste="teste" />
  <Modal :show="showModal" @close="showModal = false">
    <div class="flex w-full h-[150px] justify-center items-center">
      <p>Produto editado com sucesso!</p>
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