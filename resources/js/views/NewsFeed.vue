<template>
    <div class="flex flex-col items-center py-4">
        <NewPost></NewPost>

        <div v-if="postsStatus === 'loading'" class="mt-8">
            <Spinner></Spinner>
        </div>

        <template v-if="postsStatus === 'success'">
            <Post v-for="(post, postKey) in posts.data" :key="postKey" :post="post"></Post>
        </template>

        <p class="mt-4" v-if="postsStatus === 'success' && posts.data.length < 1">
            No posts found.
        </p>

        <p class="mt-4" v-if="postsStatus === 'error'">
            Error fetching posts.
        </p>

    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import NewPost from '../components/NewPost';
    import Post from '../components/Post';
    import Spinner from '../components/Spinner';

    export default {
        name: "NewsFeed",

        components: {
            NewPost,
            Post,
            Spinner
        },

        mounted() {
            this.$store.dispatch('fetchNewsPosts');
        },

        computed: {
            ...mapGetters({
                posts: 'posts',
                postsStatus: 'postsStatus'
            })
        }
    }
</script>

<style scoped>

</style>
