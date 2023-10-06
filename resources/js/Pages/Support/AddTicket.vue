<script setup>
import { reactive } from 'vue'
import {Link, router} from '@inertiajs/vue3'
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import CreateTicket from "@/Components/CreateTicket.vue";

</script>

<template>
    <AppLayout title="Create a new ticket">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Ticket
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div>
                    <CreateTicket :user="$page.props.auth.user" />

                </div>


            </div>
        </div>
    </AppLayout>
</template>
