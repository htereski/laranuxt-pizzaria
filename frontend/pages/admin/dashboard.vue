<template>
  <Head>
    <Title>Painel</Title>
  </Head>
  <AdminHeader />
  <Banner />
  <Panel />
  <div class="flex justify-end m-auto max-w-[1350px] px-[20px]">
    <Button label="Cadastrar" className="btn-create" path="/admin/create" />
  </div>
  <Section title="Produtos" />
  <Wrapper-Button>
    <Card>
      <p class="font-light text-center text-[16px] pb-2">4 Queijos</p>
      <Button label="Editar" className="btn-card-edit" path="/admin/edit" />
      <Button
        label="Remover"
        className="btn-card-remove cursor-pointer"
        path=""
        @click="showModal = true"
      />
    </Card>
    <Card>
      <p class="font-light text-center text-[16px] pb-2">4 Queijos</p>
      <Button label="Editar" className="btn-card-edit" path="/app/details" />
      <Button
        label="Remover"
        className="btn-card-remove cursor-pointer"
        path=""
        @click="showModal = true"
      />
    </Card>
    <Card>
      <p class="font-light text-center text-[16px] pb-2">4 Queijos</p>
      <Button label="Editar" className="btn-card-edit" path="/app/details" />
      <Button
        label="Remover"
        className="btn-card-remove cursor-pointer"
        path=""
        @click="showModal = true"
      />
    </Card>
    <Card>
      <p class="font-light text-center text-[16px] pb-2">4 Queijos</p>
      <Button label="Editar" className="btn-card-edit" path="/app/details" />
      <Button
        label="Remover"
        className="btn-card-remove cursor-pointer"
        path=""
        @click="showModal = true"
      />
    </Card>
    <Card>
      <p class="font-light text-center text-[16px] pb-2">4 Queijos</p>
      <Button label="Editar" className="btn-card-edit" path="/app/details" />
      <Button
        label="Remover"
        className="btn-card-remove cursor-pointer"
        path=""
        @click="showModal = true"
      />
    </Card>
    <Card>
      <p class="font-light text-center text-[16px] pb-2">4 Queijos</p>
      <Button label="Editar" className="btn-card-edit" path="/app/details" />
      <Button
        label="Remover"
        className="btn-card-remove cursor-pointer"
        path=""
        @click="showModal = true"
      />
    </Card>
  </Wrapper-Button>
  <Modal :show="showModal" @close="showModal = false">
    <div class="flex flex-col h-[150px] items-center justify-center gap-5">
      <p>Tem certeza que deseja remover?</p>
      <div class="w-full flex justify-around">
        <Button label="Não" className="btn-card-edit" path="/app/details" />
        <Button label="Sim" className="btn-card-remove" path="/app/details" />
      </div>
    </div>
  </Modal>
  <Footer />
</template>

<script setup>
const showModal = ref(false);
</script>