<script setup>
import {faChevronRight, faDeleteLeft} from "@fortawesome/free-solid-svg-icons";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";


// Define props to receive the players array
const props = defineProps({
    players: Array,
    game: Object,
});
</script>

<template>
    <div class="table-container">
        <table class="nk-table">
            <thead>
            <tr>
                <th colspan="3">{{game.title}}</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <th>Player</th>
                <th class="text-center">Score</th>
                <th class="text-center">Avg</th>
            </tr>
            <tr v-for="player in players" :key="player.id">
                <td>
                    <font-awesome-icon
                        v-if="player.isCurrentTurn"
                        :icon="faChevronRight"
                        class="fa-1x text-red-dark"/>

                    <font-awesome-icon
                        v-if="!player.isCurrentTurn"
                        :icon="faChevronRight"
                        class="fa-1x text-grey_lighterer"/>
                    {{ player.name }}

                </td>
                <td class="text-center">
                    <strong class="text-xl">
                        {{ player.currentScore }}
                    </strong>
                </td>
                <td class="text-center">{{ player.avgScore ?? '--' }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style>
.table-container {
    display: block;
}

.nk-table {
    width: 100%;
    table-layout: fixed;
}

.tbody-container {
    max-height: 300px; /* Adjust this height as needed */
    overflow-y: auto;
    display: block;
}

.tbody-container table {
    margin-top: -1px; /* To align with the header */
}
</style>

