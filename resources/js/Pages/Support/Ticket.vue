<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Ticket from '@/Components/Ticket.vue';

defineProps({ tickets: Array })
</script>

<template>
    <AppLayout title="Support">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Support
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow-md mb-3">
                    Create New Ticket
                </button>
                <div class="bg-white overflow-hidden sm sm:rounded-lg">
                    <Ticket :tickets="tickets" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
