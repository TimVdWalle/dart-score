<script setup>
import {  Link } from '@inertiajs/vue3';
import Button from "@/Components/CardSmall.vue";
import ButtonBig from "@/Components/CardSmall.vue";

const props = defineProps({
    href: String
});

console.log(props.href);
</script>

<template>
    <Link :href="route(this.href)">
        <ButtonBig>
            <template #icon>
                <slot name="icon"></slot>
            </template>

            <template #title>
                <slot name="title" />
            </template>

            <slot />
        </ButtonBig>
    </Link>
</template>
