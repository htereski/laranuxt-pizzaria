<template>
  <Header :links="links" />
</template>

<script setup>
const links = [
  { title: "Painel", path: "/admin/dashboard" },
  { title: "Sair", path: "/auth/login" },
];
</script>