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
                <button ref="postImage" class="dz-clickable flex justify-center items-center rounded-full w-10 h-10 bg-gray-200 hover:bg-gray-300 active:bg-gray-400 text-gray-600 hover:text-gray-700 active:text-gray-800 focus:outline-none">
                    <i class="dz-clickable icofont-image text-xl"></i>
                </button>
            </div>
        </div>

        <div class="dropzone-previews">
            <div id="dz-template" class="hidden">
                <div class="dz-preview dz-file-preview mt-5">
                    <div class="d-details w-24 relative">
                        <img data-dz-thumbnail class="w-24 h-24 rounded m-1">

                        <button data-dz-remove class="focus:outline-none absolute top-0 right-0 mr-1 mt-1 h-4 w-4 text-md text-red-400 hover:text-red-600">
                            <i class="icofont-close-circled"></i>
                        </button>
                    </div>
                    <div class="dz-progress">
                        <span class="dz-upload" data-dz-upload></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import _ from 'lodash';
    import { mapGetters } from 'vuex';
    import Dropzone from 'dropzone';

    export default {
        name: "NewPost",

        data: function() {
            return {
                dropzone: null
            }
        },

        mounted() {
            this.dropzone = new Dropzone(this.$refs.postImage, this.settings);
        },

        methods: {
            dispatchMessage() {
                if(this.dropzone.getAcceptedFiles().length && this.postMessage) {
                    this.dropzone.processQueue();
                } else {
                    this.$store.dispatch('postMessage');
                }
                this.$store.commit('updateMessage', '');
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
            },

            settings() {
                return {
                    paramName: 'image',
                    url: '/api/posts',
                    acceptedFiles: 'image/*',
                    clickable: '.dz-clickable',
                    autoProcessQueue: false,
                    maxFiles: 1,
                    previewsContainer: '.dropzone-previews',
                    previewTemplate: document.querySelector('#dz-template').innerHTML,
                    params: {
                        'width': 1000,
                        'height': 1000
                    },
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("meta[name=csrf-token]")
                            .content
                    },
                    sending: (file, xhr, formData) => {
                        formData.append('body', this.$store.getters.postMessage);
                    },
                    success: (event, res) => {
                        this.dropzone.removeAllFiles();
                        this.$store.commit('pushPost', res);
                    },
                    maxfilesexceeded: file => {
                        this.dropzone.removeAllFiles();
                        this.dropzone.addFile(file);
                    }
                };
            }
        }
    }
</script>

<style scoped>

</style>
