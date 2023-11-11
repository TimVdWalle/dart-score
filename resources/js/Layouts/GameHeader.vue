<script setup>
import {useGameStore} from "@/Stores/GameStore";
const gameStore = useGameStore();

</script>
<template>
    <nav class="bg-grey_darker w-full">
        <div class="flex  mx-6">
            <div class="py-4 w-1/2 text-white font-display italic font-black text-xl logo">
                <span>Dart</span><span>Score</span>
            </div>
<!--            <div class="w-1/2 grid grid-cols-2 text-md flex justify-center items-center">-->
<!--                <div >aan kop</div>-->
<!--                <div >Tim</div>-->
<!--                <div>beurten</div>-->
<!--                <div>4</div>-->
<!--            </div>-->
        </div>
    </nav>
<!--    <nav class="bg-grey_darker text-white font-bold ">-->
<!--        <div class="flex xl:max-w-6xl xl:mx-auto mx-6 min-h-[60px] justify-center items-center gap-x-24">-->
<!--            <div class="flex gap-x-2 items-center">-->
<!--                <div class="text-grey_lightest">-->
<!--                    Aan leiding:-->
<!--                </div>-->
<!--                <div class="text-2xl uppercase">-->
<!--                    {{gameStore.leading ?? 'tim'}}-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="flex gap-x-2 items-center">-->
<!--                <div>-->
<!--                    Beurten:-->
<!--                </div>-->
<!--                <div class="text-2xl uppercase">-->
<!--                    {{gameStore.turns ?? '-'}}-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </nav>-->
</template>
