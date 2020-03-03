<template>
    <div class="bg-white h-12 px-4 flex items-center border-b border-gray-300 shadow-sm">
        <div class="w-1/3">
            <div class="flex items-center">
                <router-link to="/">
                    <h1 class="text-xl font-bold tracking-tight">
                        <span v-if="appBranding" class="font-normal">
                            {{ appBranding }}
                        </span>
                        {{ appName }}
                    </h1>
                </router-link>

                <div class="ml-4 relative">
                    <div class="absolute py-1 px-2">
                        <i class="icofont-search text-gray-500"></i>
                    </div>
                    <input type="text"
                           name="search"
                           :placeholder="'Search ' + (appBranding ? (appBranding + ' ') : '') + appName"
                           autocomplete="off"
                           class="rounded-full pl-8 w-56 h-8 bg-gray-200 border-2 border-gray-200 focus:border-blue-300 focus:outline-none text-sm">
                </div>
            </div>
        </div>
        <div class="w-1/3 flex justify-center items-center h-full">
            <router-link to="/" class="h-full px-6 border-b-2 group flex items-center hover:border-gray-400" :class="[$route.name === 'home' ? 'border-red-400' : 'border-white']">
                <i class="icofont-home text-3xl text-gray-500 group-hover:text-gray-700"></i>
            </router-link>
            <router-link :to="'/users/' + authUser.data.user_id" class="h-full px-6 border-b-2 flex items-center hover:border-gray-400" :class="[($route.name === 'user.show' && $route.params.userId === authUser.data.user_id.toString()) ? 'border-red-400' : 'border-white']">
                <img :src="authUser.data.attributes.profile_image.data.attributes.path" alt="User avatar" class="w-8 h-8 object-cover rounded-full">
            </router-link>
            <router-link to="/notifications" class="h-full px-6 border-b-2 group flex items-center hover:border-gray-400" :class="[$route.name === 'notifications' ? 'border-red-400' : 'border-white']">
                <i class="icofont-notification text-3xl text-gray-500 group-hover:text-gray-700"></i>
            </router-link>
        </div>
        <div class="w-1/3 flex justify-end items-center h-full relative">
            <button @click="options = !options" class="h-full flex items-center text-gray-500 hover:text-gray-700 focus:outline-none" :class="[options ? 'text-gray-700' : '', loggingOut ? 'z-30' : 'z-50']">
                <i class="icofont-gear text-3xl"></i>
            </button>
            <div v-if="options && !loggingOut" class="absolute top-0 mt-10 mr-2 right-0 px-0 py-2 rounded bg-white border z-50">
                <button class="w-full py-1 px-6 hover:bg-gray-200 active:bg-gray-300 focus:outline-none">Help</button>
                <button class="w-full py-1 px-6 hover:bg-gray-200 active:bg-gray-300 focus:outline-none">Settings</button>
                <hr class="my-2">
                <button @click.prevent="logout()" class="w-full py-1 px-6 hover:bg-gray-200 active:bg-gray-300 focus:outline-none">Logout</button>
            </div>
        </div>
        <div v-if="options && !loggingOut" @click="options = false" class="absolute top-0 left-0 w-screen h-screen bg-black opacity-25 z-40"></div>
        <div v-if="loggingOut" class="absolute top-0 left-0 w-screen h-screen bg-black opacity-75 z-40 flex flex-col items-center justify-center">
            <Spinner></Spinner>
            <div class="text-gray-200 text-2xl mt-3">Logging out...</div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Spinner from './Spinner';


    export default {
        name: "Nav",

        components: {
            Spinner
        },

        data() {
            return {
                appBranding: process.env.MIX_APP_BRANDING,
                appName: process.env.MIX_APP_NAME || "",
                options: false,
                loggingOut: false
            }
        },

        methods: {
            logout()  {
                this.loggingOut = true;
                document.getElementById('logout-form').submit();
            }
        },

        computed: {
            ...mapGetters({
                authUser: 'authUser'
            })
        }
    }
</script>

<style scoped>

</style>
