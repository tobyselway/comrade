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
                <div class="ml-1 w-8">
                    <img :src="selectedContact.data.attributes.profile_image.data.attributes.path" alt="User avatar" class="w-8 h-8 object-cover rounded-full">
                </div>
                <h2 class="ml-3 text-xl font-bold tracking-tight">{{ selectedContact.data.attributes.name }}</h2>
            </div>

            <div class="w-full flex-1 overflow-y-scroll">
                <ChatThread :thread="{
                    messages: [
                        {
                            sender_type: 'me',
                            body: 'Heyy'
                        },
                        {
                            sender_type: 'other',
                            sender_img: '/default/profile.png',
                            body: 'Hello!'
                        },
                        {
                            sender_type: 'other',
                            sender_img: '/default/profile.png',
                            body: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis culpa dolorem eaque earum eius harum iure laborum magni molestiae neque odit omnis quas rem sed ullam unde velit veniam, voluptates?'
                        },
                        {
                            sender_type: 'me',
                            body: 'I\'m not sure tbh'
                        }
                    ]
                }"></ChatThread>
            </div>
        </div>

    </div>
</template>

<script>
    import ContactRow from './ContactRow';
    import ChatThread from './ChatThread';

    export default {
        name: "Contacts",

        components: {
            ContactRow,
            ChatThread
        },

        data() {
            return {
                friends: [],
                selectedContact: null,
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
