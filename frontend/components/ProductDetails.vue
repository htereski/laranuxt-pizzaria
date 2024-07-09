<template>
  <Container :label="label" :path="path">
    <div
      class="flex flex-col md:flex-row justify-center items-center w-full h-full px-[50px] gap-5 pb-[50px] md:pb-0"
    >
      <div
        class="flex flex-col w-full md:w-1/2 items-center justify-center gap-5"
      >
        <img
          src="../assets/img/pizza1.png"
          alt="img"
          class="max-w-[300px] h-[300px]"
        />
        <p
          class="text-[24px] font border-b border-black pb-1 max-w-[300px] text-center w-full"
        >
          4 Queijos
        </p>
      </div>
      <div
        class="flex flex-col w-full md:w-1/2 items-center md:items-end gap-7 inter"
      >
        <div class="max-w-[650px] text-justify">
          A pizza 4 queijos é uma delícia que se destaca pela combinação
          perfeita de queijos variados. Seus ingredientes principais incluem a
          mussarela, que derrete de forma uniforme, proporcionando uma base
          cremosa e elástica. o gorgonzola, com seu sabor picante e intenso, que
          adiciona uma complexidade única; o parmesão, ralado sobre a pizza,
          conferindo um toque salgado e uma textura ligeiramente crocante. e o
          provolone, de sabor suave a ligeiramente picante, que complementa os
          outros queijos sem dominar o paladar. Esta combinação de queijos cria
          uma harmonia de sabores rica e deliciosa, fazendo da pizza quatro
          queijos uma escolha irresistível para os amantes de queijo.
        </div>
        <div class="flex flex-col items-center">
          <div class="flex gap-1">
            <p>Quantidade:</p>
            <input
              type="number"
              min="1"
              max="100"
              step="1"
              class="w-[50px] text-center"
            />
          </div>
          <!-- <span class="text-primary">Quantidade inválida</span> -->
        </div>
      </div>
    </div>
  </Container>
</template>
  
<script setup>
const label = ["Voltar", "Adicionar ao pedido"];
const path = ["/app/home", "/app/order"];
</script>
  
<style scoped>
.font {
  font-family: "Poiret One";
}

.inter {
  font-family: "Inter";
}
</style>
