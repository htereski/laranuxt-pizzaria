<template>
  <Header :links="links" />
  <Banner />
  <Section title="Conheça" />
  <wrapper-button color="bg-[#D9D9D9]">
    <NuxtLink to="/login"
      ><Card>
        <p class="font-light text-center text-[36px] font">4 Queijos</p>
      </Card>
    </NuxtLink>
    <NuxtLink to="/login"
      ><Card>
        <p class="font-light text-center text-[36px] font">4 Queijos</p>
      </Card>
    </NuxtLink>
    <NuxtLink to="/login"
      ><Card>
        <p class="font-light text-center text-[36px] font">4 Queijos</p>
      </Card>
    </NuxtLink>
    <NuxtLink to="/login"
      ><Card>
        <p class="font-light text-center text-[36px] font">4 Queijos</p>
      </Card>
    </NuxtLink>
  </wrapper-button>
  <Footer />
</template>

<script setup>
const links = [
  { title: "Entrar", path: "/login" },
  { title: "Registrar-se", path: "/register" },
];
</script>

<style scoped>
.font {
  font-family: "Poiret One";
}
</style>
