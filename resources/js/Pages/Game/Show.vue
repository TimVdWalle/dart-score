<script setup>
import { ref } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Players from "@/Components/Game/Players.vue";

import GameLayout from "@/Layouts/GameLayout.vue";
import Keyboard from "@/Components/Game/Keyboard.vue";

const { props } = usePage();
const players = ref(props.game.players || []);
</script>

<template>
    <Head title="Game"/>

    <GameLayout>
        <Players
            :players="players"
            class="flex h-[40vh] min-h-[100px] bg-white justify-center items-center"/>

        <Keyboard class="fixed bottom-0 w-full h-[40vh] min-h-[250px]"/>

    </GameLayout>
</template>
