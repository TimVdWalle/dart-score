<script setup>
import {ref} from 'vue';
import {Head} from '@inertiajs/vue3';

import AppLayout from "@/Layouts/AppLayout.vue";
import LinedTitle from "@/Elements/LinedTitle.vue";
import Button from "@/Components/CardSmall.vue";
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faUserPlus} from "@fortawesome/free-solid-svg-icons";
import {faCircleUser} from "@fortawesome/free-solid-svg-icons";

import {useGameStore} from "@/Stores/GameStore";
import CardSmall from "@/Components/CardSmall.vue";
import TabGroup from "@/Components/TabGroup.vue";

const gameStore = useGameStore();


const playerName = ref(null);
const playerNameInput = ref(null); // add a ref for the input element

const addPlayer = () => {
    console.log("adding player ", playerName.value);
    if (playerName.value) {
        gameStore.addPlayer(playerName.value);
    } else {
        gameStore.addPlayer('speler ' + (gameStore.nextPlayerId + 1));
    }

    playerName.value = '';
    playerNameInput.value.focus(); // focus back on the input field
}

const removePlayer = (player) => {
    console.log("removing player ", player);
    if (player) {
        gameStore.removePlayer(player);
    }
}
</script>

<template>
    <Head title="Game"/>

    <AppLayout classes="xl:max-w-6xl xl:mx-auto mx-6">
        <!----------------------------------------------------
            SETTINGS
        ---------------------------------------------------->
        <lined-title class="mt-16">Settings</lined-title>
        <tab-group :options="[
                {'value':'501', 'selected': true},
                {'value':'301', 'selected': false},
                {'value':'101', 'selected': false},
            ]">
        </tab-group>

        <!----------------------------------------------------
            PLAYERS
        ---------------------------------------------------->
        <lined-title class="mt-12">Spelers</lined-title>

        <div class="flex items-center gap-x-8">
            <input
                ref="playerNameInput"
                v-model="playerName"
                v-on:keyup.enter="addPlayer"
                class="input-light min-w-[200px] max-w-[300px]" placeholder="speler 1">

            <button class="button small red" @click="addPlayer">
                <font-awesome-icon :icon="faUserPlus" class="fa-1x text-white"/>
            </button>
        </div>

        <CardSmall v-for="(player, index) in gameStore.players" :key="player.id" closeButton
                   @close="removePlayer(player)">
            <template #icon>
                <font-awesome-icon :icon="faCircleUser" class="fa-3x text-white"/>
            </template>

            <template #title>
                Speler {{ index + 1 }}
            </template>

            {{ player.name }}
        </CardSmall>


    </AppLayout>
</template>
