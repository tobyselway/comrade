<template>
  <div class="mt-6 bg-white rounded shadow w-2/3 overflow-hidden">
    <div class="flex flex-col p-4 pb-2">
      <div class="flex items-center">
        <div class="w-10">
          <img
            :src="post.data.attributes.posted_by.data.attributes.profile_image.data.attributes.path"
            alt="User avatar"
            class="w-10 h-10 object-cover rounded-full"
          />
        </div>
        <div class="ml-3 flex flex-col">
          <router-link :to="'/users/' + post.data.attributes.posted_by.data.user_id">
            <div class="text-sm font-bold">{{ post.data.attributes.posted_by.data.attributes.name }}</div>
          </router-link>
          <div class="text-sm text-gray-600 tracking-tight">{{ post.data.attributes.posted_at }}</div>
        </div>
      </div>
      <div class="mt-4" v-if="post.data.attributes.body">
        <p>{{ post.data.attributes.body }}</p>
      </div>
    </div>

    <div class="w-full mt-2" v-if="post.data.attributes.image">
      <img class="w-full" :src="post.data.attributes.image" alt="Post image" />
    </div>

    <div class="flex justify-between items-center border-1 border-gray-400 m-3">
      <div class="flex justify-between items-center">
        <button
            :disabled="post.data.tmp_vote"
          class="flex justify-center items-center p-1 rounded-full text-gray-700 w-8 h-8 bg-gray-200 hover:bg-gray-300 active:bg-gray-400 focus:outline-none"
          :class="[post.data.attributes.user_voted === 1 ? 'bg-blue-300 hover:bg-blue-400 active:bg-blue-500' : '']"
          @click="$store.dispatch('upvotePost', { postId: post.data.post_id, postKey: $vnode.key })"
        >
          <i class="icofont-arrow-up text-xl"></i>
        </button>
        <div class="mx-2 text-sm">{{ post.data.attributes.score }}</div>
        <button
            :disabled="post.data.tmp_vote"
          class="flex justify-center items-center p-1 rounded-full text-gray-700 w-8 h-8 bg-gray-200 hover:bg-gray-300 active:bg-gray-400 focus:outline-none"
          :class="[post.data.attributes.user_voted === -1 ? 'bg-blue-300 hover:bg-blue-400 active:bg-blue-500' : '']"
          @click="$store.dispatch('downvotePost', { postId: post.data.post_id, postKey: $vnode.key })"
        >
          <i class="icofont-arrow-down text-xl"></i>
        </button>
      </div>
      <div class="text-xs text-gray-500 mt-2">{{ commentCount }}</div>
      <button
        class="flex justify-center items-center py-2 rounded-lg text-sm text-gray-700 w-32 focus:outline-none"
        :class="[comments ? 'bg-gray-400 hover:bg-gray-400 active:bg-gray-300' : 'bg-gray-200 hover:bg-gray-300 active:bg-gray-400']"
        @click="toggleComments"
      >
        <i class="icofont-comment mt-1"></i>
        <span class="ml-2">Comment</span>
      </button>
    </div>

    <div v-if="comments" class="border-t border-gray-200 p-4">
      <div class="flex-1 relative flex items-center">
        <input
          ref="commentTxt"
          v-model="commentBody"
          type="text"
          name="comment"
          placeholder="Write a comment"
          class="mb-2 w-full pl-4 py-3 pr-8 h-8 text-sm rounded-full bg-gray-200 border-2 border-gray-200 focus:border-blue-300 focus:outline-none"
          @keyup.enter="postComment"
        />
        <button
          v-if="commentBody"
          @click="postComment"
          class="absolute right-0 top-0 mr-1 mt-05 text-gray-600 hover:text-gray-700 active:text-gray-800 p-0 h-8 w-8 rounded-full focus:outline-none"
        >
          <i class="icofont-arrow-right text-2xl"></i>
        </button>
      </div>

      <div
        v-for="comment in post.data.attributes.comments.data"
        v-bind:key="comment.data.comment_id"
      >
        <div class="flex mt-3 items-center">
          <div class="w-8">
            <img
              :src="comment.data.attributes.commented_by.data.attributes.profile_image.data.attributes.path"
              alt="User avatar"
              class="w-8 h-8 object-cover rounded-full"
            />
          </div>
          <div class="ml-2 flex-1">
            <div class="bg-gray-200 rounded-full py-1 px-3 text-sm">
              <router-link :to="'/users/' + comment.data.attributes.commented_by.data.user_id">
                <span
                  class="font-bold text-gray-700"
                >{{ comment.data.attributes.commented_by.data.attributes.name }}</span>
              </router-link>
              <p class="ml-1 inline">{{ comment.data.attributes.body }}</p>
            </div>
          </div>
        </div>
        <div class="text-xs flex pr-2 text-gray-500 justify-end">
          <p>{{ comment.data.attributes.commented_at }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Post",

  props: ["post"],

  data: () => {
    return {
      comments: false,
      commentBody: ""
    };
  },

  methods: {
    toggleComments() {
        this.comments = !this.comments;
    },
    postComment() {
      this.$store.dispatch("commentPost", {
        body: this.commentBody,
        postId: this.post.data.post_id,
        postKey: this.$vnode.key
      });
      this.commentBody = "";
    }
  },

  computed: {
    commentCount() {
      let c = this.post.data.attributes.comments.comment_count;
      return c === 0
        ? "no comments"
        : c === 1
        ? c + " comment"
        : c + " comments";
    }
  }
};
</script>

<style scoped>
</style>
