<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

import AppLayout from "@/Layouts/AppLayout.vue";
import LinedTitle from "@/Elements/LinedTitle.vue";
import Button from "@/Components/Button.vue";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {faUserPlus} from "@fortawesome/free-solid-svg-icons";

import {useGameStore} from "@/Stores/GameStore";
const gameStore = useGameStore();

const player = ref(null);

const addPlayer = () => {
    console.log("adding player ", player.value);
    gameStore.addPlayer(player.value);
}
</script>

<template>
    <Head title="Game" />

    <AppLayout classes="xl:max-w-6xl xl:mx-auto mx-6">
        <lined-title>Spelers</lined-title>


        <div class="flex items-center gap-x-8">
            <input v-model="player" class="input-light min-w-[200px] max-w-[300px]" placeholder="speler 1">

            <button class="button-small red" @click="addPlayer">
                <font-awesome-icon :icon="faUserPlus" class="fa-1x text-white"/></button>
        </div>

    </AppLayout>
</template>
