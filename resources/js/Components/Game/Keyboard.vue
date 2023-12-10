<script setup>
import {ref, computed} from 'vue';
import KeyboardButton from "@/Components/Game/KeyboardButton.vue";

const props = defineProps({
    button: Object,
    showDoubleButton: Boolean,
    currentPlayerScore: Number,
})

const emit = defineEmits(['scoreEntered'])
const keyboardValue = ref(0);
const doubleClicked = ref(false);
// keyboardValue.value = 0;
// doubleClicked.value = false;

const buttons = [
    {value: 1, type: 'number'},
    {value: 2, type: 'number'},
    {value: 3, type: 'number'},
    {value: 4, type: 'number'},
    {value: 5, type: 'number'},
    {value: 6, type: 'number'},
    {value: 7, type: 'number'},
    {value: 8, type: 'number'},
    {value: 9, type: 'number'},
    {value: 'faDeleteLeft', type: 'icon'},
    {value: 0, type: 'number'},
    // { value: 'fa2', type: 'icon' },
    {value: 'faArrowRightLong', type: 'icon'},
];

const doubleOutButton = {
    value: 'faArrowsDownToLine',
    type: 'icon'
}

const onButtonClicked = (pressedButton) => {
    if (pressedButton.type === 'number') {
        handleNumberClicked(pressedButton.value)
    } else if (pressedButton.value === 'faDeleteLeft') {
        handleBackspaceClicked()
    }  else if (pressedButton.value === 'faArrowsDownToLine') {
        handleDoubleClicked()
    } else if (pressedButton.value === 'faArrowRightLong') {
        emit('scoreEntered', keyboardValue.value, doubleClicked.value)
        doubleClicked.value = false;
        keyboardValue.value = 0;
    }
}

const handleNumberClicked = (value) => {
    let newKeyboardValue = keyboardValue.value * 10 + value * 1
    if (newKeyboardValue <= 180) {
        keyboardValue.value = newKeyboardValue
    }
}

const handleBackspaceClicked = (value) => {
    keyboardValue.value = Number(keyboardValue.value.toString().slice(0, -1)) || 0;
}

const handleDoubleClicked = (value) => {
    doubleClicked.value = !doubleClicked.value;
}

const showDoubleButtonCheck = computed(() => {
    return props.showDoubleButton && ((props.currentPlayerScore - keyboardValue.value) === 0); // Example logic
});
</script>

<template>
    <div>
        <div class="grid grid-cols-3 gap-1 bg-grey_dark p-1 w-full">
            <div>
            </div>
            <div class="text-center justify-center align-middle items-center flex content-center p-1 score-input h-full">
                <span>{{ keyboardValue }}</span>
            </div>
            <div :class="{'bg-blue': doubleClicked}" class="text-center justify-center align-middle items-center flex content-center p-1 score-input h-full">
                <KeyboardButton
                    v-if="showDoubleButtonCheck"

                    :button="doubleOutButton"
                    @clicked="onButtonClicked"
                />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-1 bg-grey_darker p-4 h-[30vh] fixed bottom-0 w-full">
            <div v-for="button in buttons">
                <KeyboardButton
                    :button="button"
                    @clicked="onButtonClicked"
                />
            </div>
        </div>
    </div>
</template>
