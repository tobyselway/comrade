<template>
    <div class="w-1/5 bg-white border-l border-gray-300 shadow-sm overflow-hidden">

        <div v-if="selectedContact === null" class="w-full h-full">

            <div class="p-4">
                <h2 class="text-2xl font-bold tracking-tight">Contacts</h2>
            </div>

            <div class="mt-3 w-full overflow-y-scroll">
                <div v-for="friend in friends" class="border-b first:border-t cursor-pointer" @click="selectedContact = friend">
                    <ContactRow :user="friend"></ContactRow>
                </div>
            </div>

        </div>

        <div v-else class="flex flex-col w-full h-full">

            <div class="py-4 px-3 flex items-center margin-b w-full">
                <div class="group cursor-pointer pt-1" @click="selectedContact = null">
                    <i class="icofont-simple-left text-3xl text-gray-500 group-hover:text-gray-700"></i>
                </div>
                <h2 class="ml-2 text-2xl font-bold tracking-tight">{{ selectedContact.data.attributes.name }}</h2>
            </div>

            <div class="w-full flex-1 p-4 flex flex-col justify-end overflow-y-scroll">

                <div class="w-full flex items-center justify-start mt-2">
                    <div class="bg-green-300 py-2 px-3 rounded shadow">
                        Hello there!
                    </div>
                </div>

                <div class="w-full flex items-center justify-end mt-2">
                    <div class="bg-blue-300 py-2 px-3 rounded shadow">
                        Hi!
                    </div>
                </div>

            </div>

            <div class="p-4 flex items-center margin-t w-full">
                <div class="flex-1 relative">
                    <input v-model="chatMessage" type="text" name="body" class="w-full pl-4 py-4 pr-10 h-10 rounded-full bg-gray-200 border-2 border-gray-200 focus:border-blue-300 focus:outline-none" placeholder="Write a message">
                    <button v-if="chatMessage"
                            class="absolute right-0 top-0 mt-1 mr-1 text-gray-600 hover:text-gray-700 active:text-gray-800 p-0 h-8 w-8 rounded-full focus:outline-none">
                        <i class="icofont-arrow-right text-3xl"></i>
                    </button>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import ContactRow from './ContactRow';

    export default {
        name: "Contacts",

        components: {
            ContactRow
        },

        data() {
            return {
                friends: [],
                selectedContact: null,
                chatMessage: ""
            };
        },

        mounted() {
            axios.get('/api/friends')
            .then(res => {
                this.friends = res.data.data;
            })
            .catch(err => {
                this.friends = [];
            });
        }
    }
</script>

<style scoped>

</style>
