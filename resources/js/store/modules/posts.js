import user from './user';

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
        let userVoted = state.posts.data[data.postKey].data.attributes.user_voted;
        let score = (userVoted === 1) ? 0 : 1;
        commit('quickScoreUp', { postKey: data.postKey, user_voted: userVoted });
        axios.post('/api/posts/' + data.postId + '/vote', { score: score })
            .then(res => {
                commit('updatePost', { post: res.data, postKey: data.postKey });
            })
            .catch(err => {});
    },
    downvotePost({commit, state}, data) {
        let userVoted = state.posts.data[data.postKey].data.attributes.user_voted;
        let score = (userVoted === -1) ? 0 : -1;
        commit('quickScoreDown', { postKey: data.postKey, user_voted: userVoted });
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
    quickScoreDown(state, data) {
        let userVoted = data.user_voted;
        let score = parseInt(state.posts.data[data.postKey].data.attributes.score);

        switch(userVoted) {
            case null:
            case 0: // User is downvoting for the first time
                score--;
                userVoted = -1;
                break;
            case -1: // User is removing downvote
                score++;
                userVoted = 0;
                break;
            case 1: // User is switching upvote to downvote
                score -= 2;
                userVoted = -1;
                break;
        }

        state.posts.data[data.postKey].data.attributes.user_voted = userVoted;
        state.posts.data[data.postKey].data.attributes.score = score;
        state.posts.data[data.postKey].data.tmp_vote = true;
    },
    quickScoreUp(state, data) {
        let userVoted = data.user_voted;
        let score = parseInt(state.posts.data[data.postKey].data.attributes.score);

        switch(userVoted) {
            case null:
            case 0: // User is upvoting for the first time
                score++;
                userVoted = 1;
                break;
            case 1: // User is removing upvote
                score--;
                userVoted = 0;
                break;
            case -1: // User is switching downvote to upvote
                score += 2;
                userVoted = 1;
                break;
        }

        state.posts.data[data.postKey].data.attributes.user_voted = userVoted;
        state.posts.data[data.postKey].data.attributes.score = score;
        state.posts.data[data.postKey].data.tmp_vote = true;
    }
};

export default {
    state, getters, actions, mutations
}
