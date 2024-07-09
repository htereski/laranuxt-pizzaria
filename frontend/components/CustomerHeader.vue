<template>
    <Header :links="links" />
  </template>
  
  <script setup>
  const links = [
    { title: "Meu pedido", path: "/auth/login" },
    { title: "Sair", path: "/auth/login" },
  ];
  </script>