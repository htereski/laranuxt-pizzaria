<template>
  <div
    class="max-w-[1350px] flex items-center justify-center gap-[34px] m-auto my-[50px] flex-col"
  >
    <div>
      <h2 class="font text-[40px]">Cardápio</h2>
    </div>
    <div class="flex items-center sm:gap-[70px] gap-2 px-4 w-full">
      <span class="bg-black w-[500px] h-[1px] grow"></span>
      <div
        class="h-[60px] px-[84px] py-[45px] bg-black text-white flex justify-center items-center min-w-[300px] gap-[45px]"
      >
        <NuxtLink to="/">Pizzas</NuxtLink>
        <NuxtLink to="/">Comidas</NuxtLink>
        <NuxtLink to="/">Bebidas</NuxtLink>
      </div>
      <span class="bg-black w-[500px] h-[1px] grow"></span>
    </div>
  </div>
</template>

<style scoped>
.font {
  font-family: "Poiret One";
}
</style>