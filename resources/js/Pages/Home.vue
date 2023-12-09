<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from '@inertiajs/vue3';
import Button from "@/Components/CardSmall.vue";

</script>

<template>
    <Head title="Home" />

    <AppLayout classes="h-full">
        <div class="flex justify-center items-center align-middle h-[70vh]">
            <Link :href="route('game.init')">
                <button class="nk-btn nk-btn-rounded nk-btn-color-main-1">start nieuw spel</button>
            </Link>
        </div>
    </AppLayout>
</template>
