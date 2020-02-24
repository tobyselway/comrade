import Vue from 'vue';
import Vuex from 'vuex';
import Title from './modules/title';
import User from './modules/user';
import Profile from './modules/profile';
import Posts from './modules/posts';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Title,
        User,
        Profile,
        Posts
    }
});
