<script setup>
import {ref} from 'vue';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faXmark} from "@fortawesome/free-solid-svg-icons";
import KeyboardButton from "@/Components/Game/KeyboardButton.vue";

const props = defineProps({
    closeButton: Boolean
})

const keyboardValue = ref([]);
keyboardValue.value = 0;

const onButtonClicked = (pressedValue) => {
    // Handle the click event. You might want to do something with the numberOrString.
    console.log('Button clicked with:', pressedValue);
    keyboardValue.value = keyboardValue.value * 10 + pressedValue * 1
    console.log(keyboardValue.value)
}
</script>

<template>
    <div class="grid grid-cols-3 gap-1 bg-grey_darker p-1">
        <div
            v-for="number in ['1','2','3','4','5','6','7','8','9',  'del', '0', 'undo']"
            class="flex justify-center items-center bg-grey_lighterer rounded-lg hover:bg-red hover:cursor-pointer"
        >
            <KeyboardButton
                :text="number"
                @clicked="onButtonClicked"
            />
        </div>
    </div>

</template>
