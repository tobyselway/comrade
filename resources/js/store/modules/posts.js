const state = {
    posts: null,
    postsStatus: null,
    postMessage: ''
};

const getters = {
    postsStatus: state => {
        return state.postsStatus;
    },
    posts: state => {
        return state.posts;
    },
    postMessage: state => {
        return state.postMessage;
    },
};

const actions = {
    fetchNewsPosts({commit, state}) {
        commit('setPostsStatus', 'loading');
        axios.get('/api/posts')
            .then((res) => {
                commit('setPosts', res.data);
                commit('setPostsStatus', 'success');
            })
            .catch((err) => {
                commit('setPostsStatus', 'error');
            });
    },
    fetchUserPosts({commit, dispatch}, userId) {
        commit('setPostsStatus', 'loading');
        axios.get('/api/users/' + userId + '/posts')
            .then((res) => {
                commit('setPosts', res.data);
                commit('setPostsStatus', 'success');
            })
            .catch((err) => {
                commit('setPostsStatus', 'error');
            });
    },
    postMessage({commit, state}) {
        let msg = state.postMessage;
        commit('updateMessage', '');
        axios.post('/api/posts', { body: msg })
            .then((res) => {
                commit('pushPost', res.data);
            })
            .catch((err) => {
                commit('updateMessage', msg);
            });
    },
    upvotePost({commit, state}, data) {
        let score = (state.posts.data[data.postKey].data.attributes.user_voted === 1) ? 0 : 1;
        commit('quickScore', { postKey: data.postKey, score: (score === 0 ? -1 : 1), user_voted: score });
        axios.post('/api/posts/' + data.postId + '/vote', { score: score })
            .then(res => {
                commit('updatePost', { post: res.data, postKey: data.postKey });
            })
            .catch(err => {});
    },
    downvotePost({commit, state}, data) {
        let score = (state.posts.data[data.postKey].data.attributes.user_voted === -1) ? 0 : -1;
        commit('quickScore', { postKey: data.postKey, score: (score === 0 ? 1 : -1), user_voted: score });
        axios.post('/api/posts/' + data.postId + '/vote', { score: score })
            .then(res => {
                commit('updatePost', { post: res.data, postKey: data.postKey });
            })
            .catch(err => {});
    },
    commentPost({commit, state}, data) {
        axios.post('/api/posts/' + data.postId + '/comment', { body: data.body })
            .then(res => {
                commit('pushComments', { comments: res.data, postKey: data.postKey });
            })
            .catch(err => {});
    }
};

const mutations = {
    setPosts(state, posts) {
        state.posts = posts;
    },
    setPostsStatus(state, status) {
        state.postsStatus = status;
    },
    updateMessage(state, message) {
        state.postMessage = message;
    },
    pushPost(state, post) {
        state.posts.data.unshift(post);
    },
    pushComments(state, data) {
        state.posts.data[data.postKey].data.attributes.comments = data.comments;
    },
    updatePost(state, data) {
        state.posts.data[data.postKey].data = data.post.data;
    },
    quickScore(state, data) {
        state.posts.data[data.postKey].data.attributes.user_voted = data.user_voted;
        state.posts.data[data.postKey].data.attributes.score = parseInt(state.posts.data[data.postKey].data.attributes.score) + parseInt(data.score);
    }
};

export default {
    state, getters, actions, mutations
}
