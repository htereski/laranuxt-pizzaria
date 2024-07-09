<template>
  <Container :label="label" :path="path">
    <div class="flex flex-col justify-center items-center w-full h-full px-[20px] md:px-[50px] py-[50px] md:pb-0">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full h-full">
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
        <div class="flex items-center justify-center gap-3">
          <p class="font text-[18px] flex-grow">
            Pizza 4 Queijos Argentina big
          </p>
          <p class="inter font-bold flex-grow text-right">R$64,00</p>
          <Button label="Remover" className="btn-remove inter" path="/" />
        </div>
      </div>
      <div class="flex justify-end w-full pt-[50px]">
        <p class="text-[30px] font">Total: R$76,00</p>
      </div>
    </div>
  </Container>
</template>
    
<script setup>
const label = ["Voltar", "Finalizar"];
const path = ["/app/home", "/app/home"];
</script>
    
<style scoped>
.font {
  font-family: "Poiret One";
  font-weight: 600;
}

.inter {
  font-family: "Inter";
}
</style>
