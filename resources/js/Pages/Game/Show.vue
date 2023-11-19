<script setup>
import { ref } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Scores from "@/Components/Game/Scores.vue";

import GameLayout from "@/Layouts/GameLayout.vue";
import Keyboard from "@/Components/Game/Keyboard.vue";

const { props } = usePage();
const players = ref(props.game.data.players || []);
const game = ref(props.game.data || null);
</script>

<template>
    <Head title="Game"/>

    <GameLayout>
        <div class="player-list-container">
            <Scores
                :players="players"
                :game="game"
                class="flex h-full bg-white justify-center fitems-center"/>
        </div>

        <Keyboard class="fixed bottom-0 w-full h-[35vh] min-h-[200px]"/>
    </GameLayout>
</template>


<style>
.player-list-container {
    //height: 70vh; /* Adjust this value as needed */
    overflow-y: auto; /* Allows scrolling */
}
</style>
