<script setup>
import {ref} from 'vue';
import {faUserPlus} from "@fortawesome/free-solid-svg-icons";
import Button from "@/Components/CardSmall.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faDeleteLeft} from "@fortawesome/free-solid-svg-icons";
import {faArrowRightLong} from "@fortawesome/free-solid-svg-icons";

const props = defineProps({
    button: Object
})

const emit = defineEmits(['clicked'])

const isActive = ref(false);

const handleClick = () => {
    isActive.value = true; // Set active state to true when clicked
    emit('clicked', props.button) // Emit the 'clicked' event with the button object
    setTimeout(() => isActive.value = false, 100); // Reset active state after a short delay
}

</script>

<template>
    <div :class="{'bg-red': isActive}" @click="handleClick" class="h-full w-full flex justify-center items-center bg-grey_lighterer rounded-lg hover:cursor-pointer text-2xl font-display text-white">
        <span v-if="button.type === 'number'">
        {{button.value}}
        </span>
        <span v-else-if="button.value === 'faDeleteLeft'">
            <font-awesome-icon :icon="faDeleteLeft" class="fa-1x text-white"/>
        </span>
        <span v-else-if="button.value === 'faDeleteLeft'">
            <font-awesome-icon :icon="faDeleteLeft" class="fa-1x text-white"/>
        </span>
        <span v-else-if="button.value === 'faArrowRightLong'">
            <font-awesome-icon :icon="faArrowRightLong" class="fa-1x text-white"/>
        </span>
    </div>
</template>

<style>
/* Use media queries to apply hover styles only for non-touch devices */
@media (hover: hover) {
    .hover:bg-red:hover {
        background-color: red;
    }
}
</style>
