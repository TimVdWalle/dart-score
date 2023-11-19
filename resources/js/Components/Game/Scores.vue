<script setup>
// import { defineProps } from 'vue';

// Define props to receive the players array
const props = defineProps({
    players: Array,
    game: Object,
});
</script>

<template>
    <div class="table-container">
        <table class="nk-table w-full">
            <thead>
            <tr class="headingrow">
                <th colspan="3">{{game.title}}</th>
            </tr>
            <tr>
                <th class="text-left">Player</th>
                <th class="text-center">Avg</th>
                <th class="text-center">Score</th>
            </tr>
            </thead>
        </table>
        <div class="tbody-container">
            <table class="nk-table w-full">
                <tbody>
                <tr v-for="player in players" :key="player.id">
                    <td>{{ player.name }}</td>
                    <td class="text-center">{{ player.avgScore ?? '--' }}</td> <!-- You may need to update this based on your data structure -->
                    <td class="text-center"><strong>{{ player.currentScore }}</strong></td>
                </tr>

                </tbody>
            </table>
        </div>
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

