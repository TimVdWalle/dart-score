<template>
    <GameHeader />

    <div class="" :class="props.classes">
        <slot />
    </div>
</template>

<script setup>
import Header from "@/Layouts/Header.vue";
import GameHeader from "@/Layouts/GameHeader.vue";

const props = defineProps({
    classes: String
});
</script>
