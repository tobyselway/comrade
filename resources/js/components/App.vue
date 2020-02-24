<template>
    <div v-if="authUser" class="flex flex-col flex-1 h-screen overflow-y-hidden w-full">
        <Nav></Nav>

        <div class="flex overflow-y-hidden flex-1 w-full">
            <Sidebar></Sidebar>

            <div class="overflow-x-hidden w-3/5">
                <router-view :key="$route.fullPath"></router-view>
            </div>

            <Contacts></Contacts>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Nav from './Nav';
    import Sidebar from './Sidebar';
    import Contacts from './Contacts';

    export default {
        name: "App",

        components: {
            Nav,
            Sidebar,
            Contacts
        },

        mounted() {
            this.$store.dispatch('fetchAuthUser');
        },

        created() {
            this.$store.dispatch('setPageTitle', this.$route.meta.title);
        },

        computed: {
            ...mapGetters({
                authUser: 'authUser'
            })
        },

        watch: {
            $route(to, from) {
                this.$store.dispatch('setPageTitle', to.meta.title);
            }
        }
    }
</script>

<style scoped>

</style>
