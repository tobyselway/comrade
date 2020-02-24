<template>
    <div class="w-1/5 bg-white border-r border-gray-300 shadow-sm overflow-y-scroll">
        <div class="p-4">
            <h2 class="text-2xl font-bold tracking-tight">Contacts</h2>
        </div>

        <div class="mt-3 w-full">
            <div v-for="i in 100" class="border-b first:border-t">
                <ContactRow></ContactRow>
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
        }
    }
</script>

<style scoped>

</style>
