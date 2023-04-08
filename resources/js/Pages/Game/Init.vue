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

const gameStore = useGameStore();

const player = ref(null);
const playerInput = ref(null); // add a ref for the input element

const addPlayer = () => {
    console.log("adding player ", player.value);
    if (player.value) {
        gameStore.addPlayer(player.value);
    }

    player.value = '';
    playerInput.value.focus(); // focus back on the input field
}
</script>

<template>
    <Head title="Game"/>

    <AppLayout classes="xl:max-w-6xl xl:mx-auto mx-6">
        <lined-title>Spelers</lined-title>


        <div class="flex items-center gap-x-8">
            <input
                ref="playerInput"
                v-model="player"
                v-on:keyup.enter="addPlayer"
                class="input-light min-w-[200px] max-w-[300px]" placeholder="speler 1">

            <button class="button small red" @click="addPlayer">
                <font-awesome-icon :icon="faUserPlus" class="fa-1x text-white"/>
            </button>
        </div>

        <CardSmall v-for="(player, index) in gameStore.players">
            <template #icon>
                <font-awesome-icon :icon="faCircleUser" class="fa-3x text-white"/>
            </template>

            <template #title>
                Speler {{ index + 1 }}
            </template>

            {{ player }}
        </CardSmall>

    </AppLayout>
</template>
