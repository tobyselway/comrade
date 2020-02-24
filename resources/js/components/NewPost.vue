<template>
    <div class="bg-white rounded shadow w-2/3 p-4">
        <div class="flex justify-between items-center">
            <div class="w-10">
                <img :src="authUser.data.attributes.profile_image.data.attributes.path" alt="User avatar" class="w-10 h-10 object-cover rounded-full">
            </div>
            <div class="flex-1 mx-4 relative">
                <input v-model="postMessage" @keyup.enter="dispatchMessage" type="text" name="body" class="w-full pl-4 py-4 pr-10 h-10 rounded-full bg-gray-200 border-2 border-gray-200 focus:border-blue-300 focus:outline-none" placeholder="Write a new post">
                <button v-if="postMessage"
                        @click="dispatchMessage"
                        class="absolute right-0 top-0 mt-1 mr-1 text-gray-600 hover:text-gray-700 active:text-gray-800 p-0 h-8 w-8 rounded-full focus:outline-none">
                    <i class="icofont-arrow-right text-3xl"></i>
                </button>
            </div>
            <div>
                <button class="flex justify-center items-center rounded-full w-10 h-10 bg-gray-200 hover:bg-gray-300 active:bg-gray-400 text-gray-600 hover:text-gray-700 active:text-gray-800 focus:outline-none">
                    <i class="icofont-image text-xl"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import { mapGetters } from 'vuex';

    export default {
        name: "NewPost",

        methods: {
            dispatchMessage() {
                this.$store.dispatch('postMessage');
            }
        },

        computed: {
            ...mapGetters({
                authUser: 'authUser'
            }),

            postMessage: {
                get() {
                    return this.$store.getters.postMessage;
                },
                set: _.debounce(function(postMessage) {
                    this.$store.commit('updateMessage', postMessage);
                }, 200)
            }
        }
    }
</script>

<style scoped>

</style>
