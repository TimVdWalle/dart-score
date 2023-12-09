<script setup>
// import { ref, onMounted } from 'vue';
// import { router } from '@inertiajs/vue3'
// import { Head, usePage } from '@inertiajs/vue3';
// import axios from 'axios'; // Import Axios
// import { toast } from 'vue3-toastify';
// import 'vue3-toastify/dist/index.css';
// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';
//
// import GameLayout from "@/Layouts/GameLayout.vue";
// import Keyboard from "@/Components/Game/Keyboard.vue";
// import Scores from "@/Components/Game/Scores.vue";

// const router = useRouter();
// axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;
// const clientId = Date.now() + Math.random().toString(36).substring(2, 15);

// const { props } = usePage();
// const players = ref(props.game.data.players || []);
// const game = ref(props.game.data || null);
// const currentPlayer = ref(props.game.data.currentPlayer || null);

import { ref, onMounted } from 'vue';
import {Head, Link, usePage} from '@inertiajs/vue3';

const { props } = usePage();
const winner = ref(props.winner || []);

import GameLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/CardSmall.vue";
</script>

<template>
    <Head title="Game"/>

    <GameLayout classes="h-full">
        <div class="flex justify-center content-center items-center h-full mt-52 text-5xl">
            <div>
            Winner
            <br />
            <br />
                <div class="flex justify-center content-center items-center">
            <span class="text-green-dark">
                {{winner.name}}
            </span></div>
            </div>
        </div>
        <div class="flex justify-center content-center text-blue-dark items-center h-full mt-14 text-2xl">
            <Link :href="route('game.init')">
                <button class="button big red">start nieuw spel</button>
            </Link>
        </div>

        <div class="nk-countdown nk-countdown-center" data-end="2021-11-26 08:20" data-timezone="EST"><div class="nk-hexagon">
            <div class="nk-hexagon-inner"></div>
            <span>00</span>
            <small>Days</small>
        </div>
            <div class="nk-hexagon">
                <div class="nk-hexagon-inner"></div>
                <span>00</span>
                <small>Hours</small>
            </div>
            <div class="nk-hexagon">
                <div class="nk-hexagon-inner"></div>
                <span>00</span>
                <small>Minutes</small>
            </div>
            <div class="nk-hexagon">
                <div class="nk-hexagon-inner"></div>
                <span>00</span>
                <small>Seconds</small>
            </div></div>
    </GameLayout>
</template>
