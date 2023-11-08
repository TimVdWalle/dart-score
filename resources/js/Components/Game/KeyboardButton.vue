<script setup>
import {faUserPlus} from "@fortawesome/free-solid-svg-icons";
import Button from "@/Components/CardSmall.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faDeleteLeft} from "@fortawesome/free-solid-svg-icons";

const props = defineProps({
    button: Object
})

const emit = defineEmits(['clicked'])

const handleClick = () => {
    emit('clicked', props.button) // Emit the 'clicked' event with the number
}

</script>

<template>
    <div class="h-full w-full flex justify-center items-center bg-grey_lighterer rounded-lg hover:bg-red hover:cursor-pointer text-2xl font-display text-white" @click="handleClick">
        <span v-if="button.type === 'number'">
        {{button.value}}
        </span>
        <span v-else-if="button.value === 'faDeleteLeft'">
            <font-awesome-icon :icon="faDeleteLeft" class="fa-1x text-white"/>
        </span>
        <span v-else-if="button.value === 'faDeleteLeft'">
            <font-awesome-icon :icon="faDeleteLeft" class="fa-1x text-white"/>
        </span>
    </div>
</template>
