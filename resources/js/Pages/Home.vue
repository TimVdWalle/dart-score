<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from '@inertiajs/vue3';
import Button from "@/Components/CardSmall.vue";

</script>

<template>
    <Head title="Home" />

    <AppLayout classes="tw-h-full">
        <div class="tw-flex tw-justify-center tw-items-center tw-align-middle tw-h-[70vh]">
            <Link :href="route('game.init')">
                <button class="button big red">start nieuw spel</button>
            </Link>
        </div>
    </AppLayout>
</template>
