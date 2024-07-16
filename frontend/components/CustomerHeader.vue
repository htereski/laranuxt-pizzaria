<template>
  <Header :links="links" />
</template>
  
<script setup>
const links = [
  { title: "Meu pedido", path: "/app/order" },
  { title: "Sair", path: "/auth/login" },
];
</script>