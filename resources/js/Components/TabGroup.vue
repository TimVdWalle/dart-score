<script setup>
import { ref } from 'vue';

const props = defineProps({
    tabs: Array
});

const emit = defineEmits(['select-tab']);

let selectedIndex = ref(props.tabs.findIndex(a => a.selected));

const selectTab = (selectedTab, index) => {
    props.tabs.forEach((tab) => {
        if (tab === selectedTab) {
            console.log('selecting', tab.value)
            tab.selected = true;
        } else {
            tab.selected = false;
        }
    });

    selectedIndex.value = index;
    emit('select-tab', selectedTab);
};
</script>

<template>
    <div class="flex gap-x-2 mb-3">
        <div v-for="(tab, index) in props.tabs"
             :key="index"
             @click="selectTab(tab, index)"
             :class="['bg-grey_light', {'bg-red': (index == selectedIndex)}]"
             class="p-3 flex-grow rounded flex items-center justify-center uppercase text-white font-semibold hover:bg-red hover:cursor-pointer">
            {{tab.value}}
        </div>
    </div>
</template>
