<script setup>
import { defineProps } from 'vue';

// Define props to receive the players array
const props = defineProps({
    players: Array,
});
</script>

<template>
    <div class="flex ">
        <div v-if="props.players.length > 0" class="flex justify-center items-center bg-red w-full h-full">
            {{ props.players[0].name }} <!-- Display the name of the first player -->
        </div>
        <div v-if="props.players.length > 1" class="flex justify-center items-center bg-blue w-full h-full">
            {{ props.players[1].name }} <!-- Display the name of the second player -->
        </div>
    </div>
</template>
