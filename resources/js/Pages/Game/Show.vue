<script setup>
import { ref } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Players from "@/Components/Game/Players.vue";

import GameLayout from "@/Layouts/GameLayout.vue";
import Keyboard from "@/Components/Game/Keyboard.vue";

const { props } = usePage();
const players = ref(props.game.data.players || []);
</script>

<template>
    <Head title="Game"/>

    <GameLayout>
        <div class="player-list-container">
            <Players
                :players="players"
                class="flex h-full bg-white justify-center fitems-center"/>
        </div>

        <Keyboard class="fixed bottom-0 w-full h-[30vh] min-h-[200px] bg-red"/>
    </GameLayout>
</template>


<style>
.player-list-container {
    height: 62vh; /* Adjust this value as needed */
    overflow-y: auto; /* Allows scrolling */
}
</style>
