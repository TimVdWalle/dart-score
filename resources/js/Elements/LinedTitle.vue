<template>
    <div class="">
        <div class="flex items-center py-4">
            <!-- The left line -->
            <div class="flex-grow h-1 max-w-[30px] w-30 bg-gg_grey_medium"></div>

            <!-- Your text here -->
            <span class="flex-shrink text-2xl px-4 text-gg_red uppercase font-display font-semibold">
                <slot />
            </span>

            <!-- The right line -->
            <div class="flex-grow h-1 bg-gg_grey_medium"></div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    title: String
})
</script>
