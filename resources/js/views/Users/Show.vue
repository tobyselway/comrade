<template>
    <div class="flex flex-col items-center">

        <div v-if="userStatus === 'loading'" class="mt-8">
            <!-- TODO: Replace Spinner with a new component "CoverSpinner" that preserves the top section format -->
            <Spinner></Spinner>
        </div>

        <div v-if="userStatus === 'success'" class="relative mb-8">

            <div class="w-100 h-64 overflow-hidden z-10 shadow-lg">
                <UploadableImage
                    location="cover"
                    image-height="300"
                    image-width="1500"
                    alt="Cover image"
                    classes="object-cover w-full"
                    :user-image="user.data.attributes.cover_image">
                </UploadableImage>
            </div>

            <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-8 z-20">
                <div class="w-32">
                    <UploadableImage
                        location="profile"
                        image-height="250"
                        image-width="250"
                        alt="User avatar"
                        classes="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg"
                        :user-image="user.data.attributes.profile_image">
                    </UploadableImage>
                </div>
                <p class="text-2xl text-gray-100 ml-4">{{ user.data.attributes.name}}</p>
            </div>

            <div class="absolute flex items-center bottom-0 right-0 mb-4 mr-8 z-20">
                <button v-if="friendButtonText && friendButtonText !== 'Accept'"
                        @click="$store.dispatch('sendFriendRequest', $route.params.userId)"
                        class="flex justify-center items-center px-1 py-1 rounded-lg text-gray-700 w-48 bg-gray-200 hover:bg-gray-300 active:bg-gray-400 focus:outline-none">
                    <i class="icofont-plus mt-1 text-sm"></i>
                    <span class="ml-2">{{ friendButtonText }}</span>
                </button>
                <button v-if="friendButtonText && friendButtonText === 'Accept'"
                        @click="$store.dispatch('acceptFriendRequest', $route.params.userId)"
                        class="flex justify-center items-center mr-2 px-3 py-1 rounded-lg text-gray-800 w-36 bg-green-400 hover:bg-green-500 active:bg-green-600 focus:outline-none">
                    <i class="icofont-check text-xl"></i>
                    <span class="ml-1">Accept</span>
                </button>
                <button v-if="friendButtonText && friendButtonText === 'Accept'"
                        @click="$store.dispatch('ignoreFriendRequest', $route.params.userId)"
                        class="flex justify-center items-center px-3 py-1 rounded-lg text-gray-100 w-36 bg-red-500 hover:bg-red-600 active:bg-red-700 focus:outline-none">
                    <i class="icofont-close text-xl"></i>
                    <span class="ml-2">Reject</span>
                </button>
            </div>

        </div>

        <p v-if="userStatus === 'error'">
            Error fetching user.
        </p>

        <div v-if="postsStatus === 'loading'" class="mt-8">
            <Spinner></Spinner>
        </div>

        <template v-if="postsStatus === 'success'">
            <Post v-for="(post, postKey) in posts.data" :key="postKey" :post="post"></Post>
        </template>

        <p v-if="postsStatus === 'success' && posts.data.length < 1">
            No posts found.
        </p>

        <p v-if="postsStatus === 'error'">
            Error fetching posts.
        </p>

    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Post from '../../components/Post';
    import Spinner from '../../components/Spinner';
    import UploadableImage from '../../components/UploadableImage';

    export default {
        name: "Show",

        components: {
            Post,
            Spinner,
            UploadableImage
        },

        mounted() {
            this.$store.dispatch('fetchUser', this.$route.params.userId);
            this.$store.dispatch('fetchUserPosts', this.$route.params.userId);
        },

        computed: {
            ...mapGetters({
                userStatus: 'userStatus',
                user: 'user',
                postsStatus: 'postsStatus',
                posts: 'posts',
                friendButtonText: 'friendButtonText'
            })
        }
    }
</script>

<style scoped>

</style>
