<script setup>
import {ref} from 'vue';
import {Head} from '@inertiajs/vue3';

import AppLayout from "@/Layouts/AppLayout.vue";
import LinedTitle from "@/Elements/LinedTitle.vue";
import Button from "@/Components/CardSmall.vue";
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faUserPlus} from "@fortawesome/free-solid-svg-icons";

import {useGameStore} from "@/Stores/GameStore";
import CardSmall from "@/Components/CardSmall.vue";
import TabGroup from "@/Components/TabGroup.vue";

const props = defineProps({
    gameHash: String,
    csrf: String,
})

console.log("gameHash", props.gameHash)

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

const setGameType = (option) => {
    gameStore.gameType = option.value;
}
const setOutType = (option) => {
    gameStore.outType = option.value;
}

</script>

<template>
    <Head title="Game"/>

    <AppLayout classes="xl:max-w-6xl xl:mx-auto mx-6 mt-4">
        <!----------------------------------------------------
            SETTINGS
        ---------------------------------------------------->
        <lined-title class="mt-4">Instellingen</lined-title>
        <tab-group
            @select-tab="setGameType($event)"
            :tabs="[
                {'value':'501', 'text':'501', 'selected': true},
                {'value':'301', 'text':'301', 'selected': false},
                {'value':'101', 'text':'101', 'selected': false},
                {'value':'cricket', 'text':'cricket', 'selected': false},
            ]">
        </tab-group>
        <tab-group v-if="gameStore.gameType !== 'cricket'"
            @select-tab="setOutType($event)"
            :tabs="[
                {'value': 'double_exact', 'text':'dubbel uit', 'selected': false},
                {'value': 'exact', 'text':'exact uit', 'selected': true},
                {'value': 'any', 'text':'uit', 'selected': false},
            ]">
        </tab-group>

        <!----------------------------------------------------
            PLAYERS
        ---------------------------------------------------->
        <lined-title class="mt-12">Spelers</lined-title>

        <div class="flex items-center gap-x-8 mb-8">
            <input
                ref="playerNameInput"
                v-model="playerName"
                v-on:keyup.enter="addPlayer"
                class="input-light min-w-[200px]" placeholder="speler 1">

            <button class="button small red" @click="addPlayer">
                <font-awesome-icon :icon="faUserPlus" class="fa-1x text-white"/>
            </button>
        </div>

        <div class="flex grid grid-cols-2 gap-x-4 gap-y-4 mb-16">
            <CardSmall v-for="(player, index) in gameStore.players" :key="player.id" closeButton
                       @close="removePlayer(player)">
                <!--            <template #icon>-->
                <!--                <font-awesome-icon :icon="faCircleUser" class="fa-3x text-white"/>-->
                <!--            </template>-->

                <template #title>
                    Speler {{ index + 1 }}
                </template>

                {{ player.name }}
            </CardSmall>
        </div>


        <!----------------------------------------------------
            START GAME
        ---------------------------------------------------->
        <form
            :action="route('game.store')"
            method="post" class="flex justify-center items-center">
            <input type="hidden" name="_token" :value="props.csrf">
            <input type="hidden" name="hash" :value="props.gameHash">
            <input type="hidden" name="gameType" :value="gameStore.gameType">
            <input type="hidden" name="outType" :value="gameStore.outType">
            <input type="hidden" :name="'players[]'" :value="player" v-for="player in gameStore.playerNames">

            <button type="submit" class="button big red">start spel</button>
        </form>

    </AppLayout>
</template>
