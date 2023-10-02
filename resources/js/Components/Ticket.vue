<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({ tickets: Array })
</script>

<template>
    <div>
        <div class="p-2 lg:p-4 bg-white border-b border-gray-200">

            <h1 class="mt-2 text-lg font-medium text-gray-900">
                All Tickets ({{tickets.length}})
            </h1>
        </div>

        <div class="p-4">
            <ul class="bg-white shadow-md rounded-md">
                <li v-for="ticket in tickets" :key="ticket.id" class="border-b border-gray-200 p-4 bg-white p-4 transition duration-300 transform hover:bg-gray-200">
                    <Link :href="`/ticket/${ticket.id}`">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-md font-bold mb-3">{{ ticket.title }}</h2>
                                <h5 class="text-md flex items-center">
                                    <img class="w-6 h-6 rounded-full object-cover mr-2" src="https://ui-avatars.com/api/?name=S+K&amp;color=7F9CF5&amp;background=EBF4FF" alt="Sumanta Kundu">
                                    {{ ticket.user.name }}
                                </h5>
                            </div>
                            <div>
                                <div class="mt-0">
                                    <span class="text-xs font-semibold inline-block px-2 py-1 leading-none bg-green-200 text-green-800 rounded-full" v-if="ticket.status === 'open'">Open</span>
                                    <span class="text-xs font-semibold inline-block px-2 py-1 leading-none bg-red-200 text-red-800 rounded-full" v-else>Closed</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">{{ ticket.created_at }}</p>
                            </div>
                        </div>
                    </Link>
                </li>
            </ul>
        </div>


    </div>
</template>

<style scoped>

</style>
