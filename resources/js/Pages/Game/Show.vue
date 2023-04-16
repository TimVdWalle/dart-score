<script setup>
import {ref} from 'vue';
import {Head} from '@inertiajs/vue3';
import Players from "@/Components/Game/Players.vue";

import GameLayout from "@/Layouts/GameLayout.vue";
import Keyboard from "@/Components/Game/Keyboard.vue";
</script>

<template>
    <Head title="Game"/>

    <GameLayout classes=" " style="background-color: blue">
        <Players class="flex h-[40vh] min-h-[100px] bg-white justify-center items-center bg-white"/>

        <Keyboard class="fixed bottom-0 w-full h-[30vh] min-h-[250px]"/>

    </GameLayout>
</template>
