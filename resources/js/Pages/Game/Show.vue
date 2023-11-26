<script setup>
import { ref } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Scores from "@/Components/Game/Scores.vue";
import axios from 'axios'; // Import Axios

import GameLayout from "@/Layouts/GameLayout.vue";
import Keyboard from "@/Components/Game/Keyboard.vue";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;
const { props } = usePage();
const players = ref(props.game.data.players || []);
const game = ref(props.game.data || null);
const currentPlayer = ref(props.game.data.currentPlayer || null);

const onScoreEntered = (score) => {
    console.log("received score", score);

    try {
        axios.post('/api/game/' + game.value.hash + '/score', {
            score: score,
            player_id: currentPlayer.value.id,
        })
        .then(response => {
            console.log(response.data);
            updateGame(response.data.game);
            showToast(response.data.message, 'success')
        })
        .catch(error => {
            console.error('error = ', error);
            if (error.response && error.response.data && error.response.data.message) {
                showToast(error.response.data.message, 'error')
            } else {
                showToast('Unexpected error:', error);
            }
        });
    } catch (error) {
        // Handle errors here, such as displaying a message to the user
        console.error('Error submitting score:', error);
    }
}

const updateGame = (game) => {
    console.log("updating game with: ", game)
    players.value = game.players;
    currentPlayer.value = game.currentPlayer;
}

const showToast = (message, type) => {
    if(type === 'success'){
        toast.success(message, {
            autoClose: 700,
            theme: 'colored',
        });
    }

    if(type === 'error'){
        toast.error(message, {
            autoClose: 3500,
            theme: 'colored',
        });
    }
}
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

        <Keyboard
            @scoreEntered="onScoreEntered"
            class="fixed bottom-0 w-full h-[35vh] min-h-[200px]"
        />
    </GameLayout>
</template>


<style>
.player-list-container {
    //height: 70vh; /* Adjust this value as needed */
    overflow-y: auto; /* Allows scrolling */
}
</style>
