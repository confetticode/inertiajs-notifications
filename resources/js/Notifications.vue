<script setup>
import {usePage} from "@inertiajs/inertia-vue3"
import Notification from "./Notification.vue"

const notifications = usePage().props.value.notifications.map((notification) => {
    notification.visible = true

    return notification
});

const hasNotifications = () => {
    return notifications.filter(n => n.visible).length > 0
}
</script>

<template>
    <div v-show="hasNotifications()" class="absolute right-7 top-9 w-96">
        <Notification v-for="notification in notifications" :message="notification" />
    </div>
</template>
