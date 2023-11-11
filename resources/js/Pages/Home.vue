<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from '@inertiajs/vue3';
import Button from "@/Components/CardSmall.vue";
import LinkButton from "@/Components/LinkButton.vue";

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {faCircleUser} from "@fortawesome/free-solid-svg-icons";

</script>

<template>
    <Head title="Home" />

   <AppLayout classes="flex justify-center items-center h-[70vh] mt-4">

       <Link :href="route('game.init')">
            <button class="button big red">start nieuw spel</button>
       </Link>
   </AppLayout>
</template>
