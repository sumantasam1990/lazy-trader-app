<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({ tickets: Array, total_tickets: Number, })
</script>

<template>
    <div>
        <div class="p-2 lg:p-4 bg-white border-b border-gray-200 flex justify-between items-center">

            <h1 class="mt-2 text-lg font-medium text-gray-900">
                All Tickets ({{total_tickets}})
            </h1>

            <div class="flex justify-start p-2 items-center space-x-4 mt-0">
                <Link :href="tickets.prev_page_url" class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded" :class="{'opacity-50 cursor-not-allowed': !tickets.prev_page_url}">
                    &laquo; Previous
                </Link>

                <Link :href="tickets.next_page_url" class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded" :class="{'opacity-50 cursor-not-allowed': !tickets.next_page_url}">
                    Next &raquo;
                </Link>
            </div>

        </div>

        <div class="p-4">
            <ul class="bg-white shadow-md rounded-md">
                <li v-for="ticket in tickets.data" :key="ticket.id" class="border-b border-gray-200 p-4 bg-white p-4 transition duration-300 transform hover:bg-gray-200">
                    <Link :href="`/ticket/message/${ticket.id}`">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500 mb-2">Ticket: {{ticket.ticket_no}}</p>
                                <h2 class="text-md font-bold mb-3">{{ ticket.title }}</h2>
                                <h5 class="text-sm flex items-center">
                                    <img class="w-6 h-6 rounded-full object-cover mr-2" src="https://ui-avatars.com/api/?name=S+K&amp;color=ffffff&amp;background=EBF4FF;font-weight=bold" alt="user avatar">
                                    {{ ticket.user.name }}
                                </h5>
                                <div v-for="file in ticket.ltFiles" :key="file.id">
                                    <img :src="file.file_url" alt="">
                                </div>

                            </div>
                            <div>
                                <div class="mt-0">
                                    <span class="text-xs font-semibold inline-block px-2 py-1 leading-none bg-blue-200 text-green-800 rounded-full" v-if="ticket.status === 'open'">Open</span>
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
