<script setup>
import {ref} from 'vue';
import KeyboardButton from "@/Components/Game/KeyboardButton.vue";

const keyboardValue = ref([]);
keyboardValue.value = 0;

const buttons = [
    { value: 1, type: 'number' },
    { value: 2, type: 'number' },
    { value: 3, type: 'number' },
    { value: 4, type: 'number' },
    { value: 5, type: 'number' },
    { value: 6, type: 'number' },
    { value: 7, type: 'number' },
    { value: 8, type: 'number' },
    { value: 9, type: 'number' },
    { value: 'faDeleteLeft', type: 'icon' },
    { value: 0, type: 'number' },
    { value: 'faArrowRightLong', type: 'icon' },
];

const onButtonClicked = (pressedButton) => {
    if(pressedButton.type === 'number'){
        handleNumberClicked(pressedButton.value)
    } else if (pressedButton.value === 'faDeleteLeft'){
        handleBackspace()
    }
}

const handleNumberClicked = (value) => {
    let newKeyboardValue = keyboardValue.value * 10 + value * 1
    if(newKeyboardValue <= 180){
        keyboardValue.value = newKeyboardValue
    }
}

const handleBackspace = (value) => {
    keyboardValue.value = Number(keyboardValue.value.toString().slice(0, -1)) || 0;
}
</script>

<template>
    <div>
        <div class="">
            <span>{{keyboardValue}}</span>
        </div>
        <div class="grid grid-cols-3 gap-1 bg-grey_darker p-1 h-[30vh] fixed bottom-0 w-full">
            <div v-for="button in buttons">
                <KeyboardButton
                    :button="button"
                    @clicked="onButtonClicked"
                />
            </div>
        </div>
    </div>

</template>
