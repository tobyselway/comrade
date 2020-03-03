<template>
    <div class="w-full h-full">

        <div class="w-100 overflow-hidden z-10 shadow-lg">
            <div class="w-100 h-96 flex items-center justify-center bg-gray-300">
                <Spinner></Spinner>
            </div>
        </div>

        <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-10 z-20">
            <div class="w-32">
                <div class="flex items-center justify-center w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg bg-gray-300">
                    <Spinner class="ml-2 mt-2"></Spinner>
                </div>
            </div>
            <p class="text-2xl font-black text-gray-100 ml-4"></p>
        </div>

    </div>
</template>

<script>
    import Spinner from './Spinner';

    export default {
        name: "CoverSpinner",

        components: {
            Spinner
        }
    }
</script>

<style scoped>

</style>
