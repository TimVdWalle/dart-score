<script setup>
import {useGameStore} from "@/Stores/GameStore";
const gameStore = useGameStore();

</script>
<template>
    <nav class="bg-grey_darker text-white font-bold ">
        <div class="flex xl:max-w-6xl xl:mx-auto mx-6 min-h-[60px] justify-center items-center gap-x-24">
            <div class="flex gap-x-2 items-center">
                <div class="text-grey_lightest">
                    Aan leiding:
                </div>
                <div class="text-2xl uppercase">
                    {{gameStore.leading ?? 'tim'}}
                </div>
            </div>
            <div class="flex gap-x-2 items-center">
                <div>
                    Beurten:
                </div>
                <div class="text-2xl uppercase">
                    {{gameStore.turns ?? '-'}}
                </div>
            </div>
        </div>
    </nav>
</template>
