<script setup>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faXmark} from "@fortawesome/free-solid-svg-icons";

const props = defineProps({
    closeButton: Boolean
})
</script>

<template>
    <div
        class="flex relative min-w-80 my-6 p-5 bg-grey_medium gap-x-4 text-white font-display font-bold uppercase text-lg px-5 rounded fhover:cursor-pointer fhover:bg-red group">
        <div v-if="closeButton" @click="$emit('close')" class="absolute top-0 right-0 flex p-2">
            <font-awesome-icon :icon="faXmark" class="fa-lg text-grey_lighter hover:text-grey_lightest hover:cursor-pointer" />
        </div>

        <div v-if="$slots.icon" class="px-2">
            <slot name="icon"/>
        </div>

        <div class="flex flex-col items-start">
            <div v-if="$slots.title">
                <slot name="title"/>
            </div>
            <div class="text-red fgroup-hover:text-white">
                <slot/>
                {{ closeButton }}
            </div>
        </div>
    </div>
</template>
