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
                <th>Name</th>
                <th>Game Line</th>
                <th class="text-center">Percent</th>
            </tr>
            </thead>
        </table>
        <div class="tbody-container">
            <table class="nk-table w-full">
                <tbody>
                <tr>
                    <td>Duke</td>
                    <td>Top</td>
                    <td class="text-center"><strong>85</strong></td>
                </tr>
                <tr>
                    <td>Duke</td>
                    <td>Top</td>
                    <td class="text-center"><strong>85</strong></td>
                </tr>
                <tr>
                    <td>Duke</td>
                    <td>Top</td>
                    <td class="text-center"><strong>85</strong></td>
                </tr>
                <tr>
                    <td>Duke</td>
                    <td>Top</td>
                    <td class="text-center"><strong>85</strong></td>
                </tr>
                <tr>
                    <td>Duke</td>
                    <td>Top</td>
                    <td class="text-center"><strong>85</strong></td>
                </tr>
                <tr>
                    <td>Duke</td>
                    <td>Top</td>
                    <td class="text-center"><strong>85</strong></td>
                </tr>
                <tr>
                    <td>Duke</td>
                    <td>Top</td>
                    <td class="text-center"><strong>85</strong></td>
                </tr>
                <tr>
                    <td>Duke</td>
                    <td>Top</td>
                    <td class="text-center"><strong>85</strong></td>
                </tr></tbody>
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

