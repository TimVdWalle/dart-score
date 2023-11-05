<script setup>
/*
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faXmark} from "@fortawesome/free-solid-svg-icons";
*/

const props = defineProps({
    text: String
})

const emit = defineEmits(['clicked'])

const handleClick = () => {
    emit('clicked', props.text) // Emit the 'clicked' event with the number
}

</script>

<template>
    <div class="text-2xl font-display text-white" @click="handleClick">
        {{text}}
    </div>
</template>
