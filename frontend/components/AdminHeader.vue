<template>
  <Header :links="links" />
</template>

<script setup>
const links = [
  { title: "Painel", path: "/auth/login" },
  { title: "Sair", path: "/auth/login" },
];
</script>