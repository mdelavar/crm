<template>
    <Main v-if="isLoggedIn"></Main>
    <Login v-else></Login>
</template>
<script setup>
import Login from "@/Pages/Profile/Login.vue";
import auth from "@/auth.js";
import Main from "@/Pages/Profile/Main.vue";
</script>
