<template>
  <div class="h-[476px] bg-[#E3170A] flex justify-center mt-[68px]">
    <img class="max-xl:hidden" src="../assets/img/banner.PNG" alt="logo" />
    <div
      class="change flex flex-col justify-between py-[30px] px-[10px] text-center"
    >
      <h2 class="max-w-[800px] text-[64px] text-white font-light">
        Sabores que conquistam corações, pizzas que transformam momentos.
      </h2>
      <h2 class="max-w-[800px] text-[64px] text-white">
        Bem-vindo à Laranuxt!
      </h2>
    </div>
  </div>
</template>

<style scoped>
.font {
  font-family: "Inter", sans-serif;
  letter-spacing: 0.05em;
  line-height: 77px;
}

@media (width <= 1450px) {
  h2 {
    font-size: 54px;
  }
}

@media (width <= 1310px) {
  h2 {
    font-size: 50px;
  }

  .change {
    justify-content: space-around;
    line-height: 60px;
  }
}

@media (width <= 769px) {
  h2 {
    font-size: 34px;
  }
}
</style>