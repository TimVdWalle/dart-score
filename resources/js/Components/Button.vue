<template>
    <div class="flex w-80 p-5 bg-gg_grey_medium gap-x-4 text-white font-display font-bold uppercase text-lg px-5 rounded hover:cursor-pointer hover:bg-gg_red group" >
        <div v-if="$slots.icon" class="px-2">
            <slot name="icon"/>
        </div>

        <div class="flex flex-col items-start">
            <div v-if="$slots.title">
                <slot name="title"/>
            </div>
            <div class="text-gg_red group-hover:text-white">
            <slot/>
            </div>
        </div>
    </div>
</template>
