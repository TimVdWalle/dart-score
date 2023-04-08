<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from '@inertiajs/vue3';
import Button from "@/Components/Button.vue";
import LinkButton from "@/Components/LinkButton.vue";

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {faBullseye} from "@fortawesome/free-solid-svg-icons";
</script>

<template>
    <Head title="Home" />

   <AppLayout classes="flex justify-center items-center h-[70vh]">
        <LinkButton href="game.init">
            <template #icon>
                <font-awesome-icon :icon="faBullseye" class="fa-3x text-white"/>
            </template>

            <template #title>
                dart
            </template>

            start spel
        </LinkButton>
   </AppLayout>
</template>
