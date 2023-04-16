<script setup>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faXmark} from "@fortawesome/free-solid-svg-icons";

const props = defineProps({
    closeButton: Boolean
})
</script>

<template>
    <div class="grid grid-cols-3 gap-1 bg-grey_lighterer p-1">
        <div
            v-for="number in [1,2,3,4,5,6,7,8,9, 0, 'del', 'undo']"
            class="flex justify-center items-center bg-grey_medium h-full w-full font-display text-2xl rounded-lg hover:bg-blue-dark"
        >
            {{number}}
        </div>
    </div>

</template>
