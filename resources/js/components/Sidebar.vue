<template>
    <div class="w-1/5 bg-white border-r border-gray-300 shadow-sm">
        <div class="p-4">
            <h2 class="text-2xl font-bold tracking-tight">Home</h2>
        </div>

        <div class="mt-3 w-full">

            <div class="border-b first:border-t">
                <div @click="sorting = 'most-recent'" class="flex items-center h-12 w-full px-3 py-1 hover:bg-gray-200 group cursor-pointer" :class="[sorting === 'most-recent' ? 'bg-gray-200 border-r-4 border-red-400' : '']">
                    <div class="w-8 text-center">
                        <i class="icofont-clock-time text-3xl group-hover:text-gray-700" :class="[sorting === 'most-recent' ? '' : 'text-gray-500']"></i>
                    </div>
                    <div class="ml-3">
                        <div class="font-bold" :class="[sorting === 'most-recent' ? '' : 'text-gray-500']">Most Recent</div>
                    </div>
                </div>
            </div>

            <div class="border-b first:border-t">
                <div @click="sorting = 'most-voted'" class="flex items-center h-12 w-full px-3 py-1 hover:bg-gray-200 group cursor-pointer" :class="[sorting === 'most-voted' ? 'bg-gray-200 border-r-4 border-red-400' : '']">
                    <div class="w-8 text-center">
                        <i class="icofont-arrow-up text-3xl group-hover:text-gray-700" :class="[sorting === 'most-voted' ? '' : 'text-gray-500']"></i>
                    </div>
                    <div class="ml-3">
                        <div class="font-bold" :class="[sorting === 'most-voted' ? '' : 'text-gray-500']">Most Voted</div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</template>

<script>
    export default {
        name: "Sidebar",

        data: function() {
            return {
                sorting: 'most-recent'
            }
        }
    }
</script>

<style scoped>

</style>
