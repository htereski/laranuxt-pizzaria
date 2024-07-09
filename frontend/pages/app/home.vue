<template>
  <Head>
    <Title>Home</Title>
  </Head>
  <div>
    <Customer-Header />
    <Banner />
    <Menu />
    <div>
      <template v-if="msg !== ''">
        <Message :msg="msg" :type="type" />
      </template>
      <Section title="Tradicionais" />
      <Wrapper-Button>
        <Card>
          <p class="font-light text-center text-[16px] font">4 Queijos</p>
          <Button label="Pedir" className="btn-card-remove" path="/app/details" />
        </Card>
        <Card>
          <p class="font-light text-center text-[16px] font">4 Queijos</p>
          <Button label="Pedir" className="btn-card-remove" path="/app/details" />
        </Card>
        <Card>
          <p class="font-light text-center text-[16px] font">4 Queijos</p>
          <Button label="Pedir" className="btn-card-remove" path="/app/details" />
        </Card>
        <Card>
          <p class="font-light text-center text-[16px] font">4 Queijos</p>
          <Button label="Pedir" className="btn-card-remove" path="/app/details" />
        </Card>
      </Wrapper-Button>
      <Footer />
    </div>
  </div>
</template>

<script setup>
const msg = ref("Pedido realizado com sucesso");
const type = ref("success")
</script>

<style scoped>
.font {
  font-family: "Inter";
}
</style>