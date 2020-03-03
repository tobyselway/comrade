<template>
    <div class="flex flex-col items-center py-4 px-6">
        <h1 class="text-2xl font-bold tracking-tight mb-6">Notifications</h1>
        <div class="w-2/5">
            <div v-if="state === 'loading'" class="flex flex-col items-center">
                <Spinner></Spinner>
            </div>
            <div v-if="state === 'success'">
                <div v-if="!notifications">
                    You have no notifications.
                </div>
                <div v-else v-for="notification in notifications" class="mb-3">
                    <Notification :notification="notification"></Notification>
                </div>
            </div>
            <div v-if="state === 'error'" class="flex flex-col items-center">
                Error retrieving notifications.
            </div>
        </div>
    </div>
</template>

<script>
    import Notification from '../components/Notification';
    import Spinner from '../components/Spinner';

    export default {
        name: "Notifications",

        data: function() {
            return {
                notifications: null,
                state: 'loading'
            }
        },

        components: {
            Notification,
            Spinner
        },

        mounted() {
            this.state = 'loading';
            axios.get('/api/notifications')
                .then(res => {
                    this.notifications = res.data.data;
                    this.state = 'success';
                })
                .catch(err => {
                    this.state = 'error';
                });
        }
    }
</script>

<style scoped>

</style>
