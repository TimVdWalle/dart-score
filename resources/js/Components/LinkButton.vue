<template>
    <Link :href="route(this.href)">
        <Button>
            <template #icon>
                <slot name="icon"></slot>
            </template>

            <template #title>
                <slot name="title" />
            </template>

            <slot />
        </Button>
    </Link>
</template>

<script setup>
import {  Link } from '@inertiajs/vue3';
import Button from "@/Components/Button.vue";

const props = defineProps({
    href: String
});

console.log(props.href);
</script>

