<template>
    <Header />

    <div class="mt-4" :class="props.classes">
        <slot />
    </div>
</template>

<script setup>
import Header from "@/Layouts/Header.vue";

const props = defineProps({
    classes: String
});
</script>
