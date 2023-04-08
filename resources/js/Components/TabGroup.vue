<script setup>

const props = defineProps({
    options: Array
});

console.log(props.options)
</script>

<template>
    <div class="flex gap-x-2">
        <div v-for="option in options"
             :class="['bg-grey_light', {'bg-red': option.selected}]"
             class="p-3 flex-grow rounded flex items-center justify-center uppercase text-white font-semibold hover:bg-red hover:cursor-pointer">
            {{option.value}}
        </div>
    </div>
</template>
