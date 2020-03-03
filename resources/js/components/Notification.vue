<template>
    <div class="bg-white rounded shadow p-1 pb-2 flex flex-col justify-between">
        <div class="flex items-center justify-between text-xs px-1">
            <div class="font-bold text-gray-600">{{ notification.data.attributes.type }}</div>
            <div class="text-gray-600">{{ notification.data.time_ago }}</div>
        </div>
        <div class="p-2 m-1">{{ notification.data.attributes.data.body }}</div>
        <div v-if="notification.data.attributes.type === 'Comment on Post'" class="px-5 mb-2 text-sm text-gray-600">{{ notification.data.attributes.data.comment }}</div>
        <!--
        <div class="flex items-center justify-between text-xs px-1 mb-1">
            <button class="px-2 py-1 rounded focus:outline-none bg-blue-200 hover:bg-blue-300 active:bg-blue-400">View</button>
            <button class="px-2 py-1 rounded focus:outline-none bg-gray-200 hover:bg-gray-300 active:bg-gray-400">Dismiss</button>
        </div>
        -->
    </div>
</template>

<script>
    export default {
        name: "Notification",

        props: [
            'notification'
        ]
    }
</script>

<style scoped>

</style>
