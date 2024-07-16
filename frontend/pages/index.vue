<template>
  <Head>
    <Title>Laranuxt</Title>
  </Head>
  <Header :links="links" />
  <Banner />
  <Section title="Conheça" />
  <Wrapper-Button color="bg-[#D9D9D9]">
    <NuxtLink to="/auth/login"
      ><Card>
        <p class="font-light text-center text-[36px] font">4 Queijos</p>
      </Card>
    </NuxtLink>
    <NuxtLink to="/auth/login"
      ><Card>
        <p class="font-light text-center text-[36px] font">4 Queijos</p>
      </Card>
    </NuxtLink>
    <NuxtLink to="/auth/login"
      ><Card>
        <p class="font-light text-center text-[36px] font">4 Queijos</p>
      </Card>
    </NuxtLink>
    <NuxtLink to="/auth/login"
      ><Card>
        <p class="font-light text-center text-[36px] font">4 Queijos</p>
      </Card>
    </NuxtLink>
  </Wrapper-Button>
  <Footer />
</template>

<script setup>
const links = [
  { title: "Entrar", path: "/auth/login" },
  { title: "Registrar-se", path: "/auth/register" },
];
</script>

<style scoped>
.font {
  font-family: "Poiret One";
}
</style>
