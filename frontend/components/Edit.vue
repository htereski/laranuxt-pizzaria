<template>
  <Container
    @handleFirstClick="handleFirstClick"
    :label="label"
    :path="path"
    class="flex-grow"
    :isCreateContext="true">
    <div
      class="flex flex-col justify-center items-center w-full h-full px-[20px] md:px-[50px] md:py-0 py-[50px] md:pb-0">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full h-full">
        <div class="flex flex-col gap-8 items-center">
          <Input type="text" title="Tipo" />
          <Input type="text" title="Nome" />
          <Input type="text" title="Tamanho" />
          <Input type="text" title="Categoria" />
          <Input type="number" title="Quantidade" />
          <Input type="number" title="Preço" />
        </div>
        <div class="flex flex-col items-center">
          <div
            class="max-w-[500px] h-full flex flex-col items-center justify-center">
            <img
              v-if="imageSrc"
              :src="imageSrc"
              class="max-w-[250px] max-h-[250px]"
              alt="imagem"/>
            <div v-else class="w-full h-[250px]"></div>
          </div>
          <input
            @change="previewImage"
            type="file"
            accept="image/png, image/jpeg"/>
        </div>
      </div>
    </div>
  </Container>
</template>
  
<script setup>
const label = ["Cancelar", "Editar"];
const path = ["/admin/dashboard", "/app/home"];

const emit = defineEmits(["teste"]);

const imageSrc = ref(null);

function previewImage(event) {
  const input = event.target;
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = (e) => {
      imageSrc.value = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function handleFirstClick(data) {
  teste();
}

function teste() {
  emit("teste", true);
}
</script>