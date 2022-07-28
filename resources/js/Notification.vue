<script setup>
import {onMounted, reactive} from "vue";

const props = defineProps({
    message: Object,
})

const close = () => {
    props.message.visible = false
}

onMounted(() => {
    setTimeout(() => {
        props.message.visible = false
    }, props.message.duration || 3000)
})
</script>

<template>
    <div v-if="message.visible" class="flex shadow bg-white text-gray-800 px-5 py-5 rounded-lg mb-5 relative">
        <svg v-if="message.type === 'info'" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500 -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg v-if="message.type === 'success'" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-500 -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg v-if="message.type === 'danger'" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-500 -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div class="px-2 leading-6">
            <h2 class="font-bold">{{ message.title }}</h2>
            <p class="mt-1 mb-3">{{ message.body }}</p>
            <div v-if="Array.isArray(message.actions) && message.actions.length > 0" class="text-sm">
                <a v-for="action in message.actions" :href="action.url" :title="action.title" :class="{
                    'bg-yellow-600 hover:opacity-90 text-white px-3 py-1 rounded font-bold mr-2': action.type === 'primary',
                    'font-bold hover:underline mr-2': action.type === 'secondary',
                }">{{ action.title }}</a>
            </div>
        </div>
        <button class="absolute -top-3 -right-3" @click="close">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 p-2 rounded-full shadow bg-white text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</template>
