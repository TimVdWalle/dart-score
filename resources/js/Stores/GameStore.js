import {defineStore} from 'pinia';
import Player from "@/Models/Player";
// import axios from "axios";
// import {useInterfaceStore} from "@/stores/interface";
//const interfaceStore = useInterfaceStore();

export const useGameStore = defineStore('game', {
    state: () => {
        return {
            nextPlayerId: 0,
            players: []
        }
    },
    actions: {
        setPlayers(players) {
            this.players = players;
        },

        addPlayer(playerName) {
            const playerObject = new Player({
                id: this.nextPlayerId,
                name: playerName
            });
            this.players.push(playerObject);
            this.nextPlayerId++;
        },

        removePlayer(player) {
            const index = this.players.findIndex(p => p.id === player.id)
            if (index !== -1) {
                this.players.splice(index, 1)
            }
        }
    },
})
