<template>
    <Header />

    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <slot></slot>
    </div>
</template>

<script setup>
import Header from "@/Layouts/Header.vue";
</script>
