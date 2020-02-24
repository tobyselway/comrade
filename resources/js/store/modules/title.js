const state = {
    title: 'Welcome'
};

const getters = {
    pageTitle: state => {
        return state.title;
    }
};

const actions = {
    setPageTitle({commit, state}, title) {
        commit('setTitle', title);
    }
};

const mutations = {
    setTitle(state, title) {
        state.title = title + ' | ' + (process.env.MIX_APP_BRANDING || '') + ' ' + (process.env.MIX_APP_NAME || 'Comrade');
        document.title = state.title;
    }
};

export default {
    state, getters, actions, mutations
}
