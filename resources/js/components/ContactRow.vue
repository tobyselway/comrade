<template>
    <div class="flex items-center h-16 w-full px-3 py-1 hover:bg-gray-200">
        <div class="w-10">
            <img :src="user.data.attributes.profile_image.data.attributes.path" alt="User avatar" class="w-10 h-10 object-cover rounded-full">
        </div>
        <div class="ml-3">
            <div class="text-sm font-bold">{{ user.data.attributes.name }}</div>
            <div class="text-xs">Online 13 mins ago</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContactRow",

        props: [
            'user'
        ]
    }
</script>

<style scoped>

</style>
