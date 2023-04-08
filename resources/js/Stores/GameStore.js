import {defineStore} from 'pinia'
// import axios from "axios";
// import {useInterfaceStore} from "@/stores/interface";
//const interfaceStore = useInterfaceStore();

export const useGameStore = defineStore('game', {
    state: () => {
        return {
            players: []
        }
    },
    actions: {
        setPlayers(players) {
            this.players = players;
        },

        addPlayer(player) {
            this.players.push(player);
        }
    },
})
