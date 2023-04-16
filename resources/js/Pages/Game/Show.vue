<script setup>
import {ref} from 'vue';
import {Head} from '@inertiajs/vue3';
import Players from "@/Components/Game/Players.vue";

import GameLayout from "@/Layouts/GameLayout.vue";
import Keyboard from "@/Components/Game/Keyboard.vue";
</script>

<template>
    <Head title="Game"/>

    <GameLayout classes=" ">
        <Players class="flex h-[25vh] min-h-[150px] bg-white justify-center items-center bg-white"/>

        <Keyboard class="flex mt-3 fixed bottom-0 w-full h-[35vh] min-h-[250px] bg-white justify-center items-center bg-white" />

    </GameLayout>
</template>
