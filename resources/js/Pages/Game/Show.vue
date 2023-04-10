<script setup>
import {ref} from 'vue';
import {Head} from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';


import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <Head title="Game"/>

    <AppLayout classes=" bg-white">
        <GameStatus />
    </AppLayout>
</template>
