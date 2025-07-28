<template>
    <Main v-if="isLoggedInCarService"></Main>
    <Login v-else></Login>
</template>
<script setup>
import Login from "./Login.vue";
import Main from "./Main.vue";
</script>
