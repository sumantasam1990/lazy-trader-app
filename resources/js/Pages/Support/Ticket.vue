<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Ticket from '@/Components/Ticket.vue';
import {Link} from '@inertiajs/vue3'

defineProps({ tickets: Array, total_tickets: Number, })
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
                <Link :href="route('support.ticket.create')" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow-md mb-2">
                    Create New Ticket
                </Link>
                <div class="bg-white overflow-hidden sm sm:rounded-lg mt-3">
                    <Ticket :tickets="tickets" :total_tickets="total_tickets" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
