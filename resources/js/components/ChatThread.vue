<template>
    <div class="w-full h-full flex flex-col">
        <div class="w-full p-4 flex-1 flex flex-col justify-end">

            <div v-for="message in thread.messages">

                <div v-if="message.sender_type === 'other'" class="w-full flex items-end justify-start mt-3">
                    <div class="w-8 flex-shrink-0">
                        <img :src="message.sender_img" alt="User avatar" class="w-8 h-8 object-cover rounded-full">
                    </div>
                    <div class="ml-2 flex-shrink bg-green-300 py-1 px-3 rounded-lg rounded-bl-none shadow">{{ message.body }}</div>
                </div>

                <div v-if="message.sender_type === 'me'" class="w-full flex items-end justify-end mt-3">
                    <div class="bg-blue-300 py-1 px-3 rounded-lg rounded-br-none shadow">{{ message.body }}</div>
                </div>

            </div>

        </div>

        <div class="w-full p-4 flex items-center margin-t">
            <div class="flex-1 relative">
                <input v-model="chatMessage" type="text" name="body" class="w-full pl-4 py-4 pr-10 h-10 rounded-full bg-gray-200 border-2 border-gray-200 focus:border-blue-300 focus:outline-none" placeholder="Write a message">
                <button v-if="chatMessage"
                        class="absolute right-0 top-0 mt-1 mr-1 text-gray-600 hover:text-gray-700 active:text-gray-800 p-0 h-8 w-8 rounded-full focus:outline-none">
                    <i class="icofont-arrow-right text-3xl"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatThread",

        props: [
            'thread'
        ],

        data() {
            return {
                chatMessage: ""
            };
        },
    }
</script>

<style scoped>

</style>
