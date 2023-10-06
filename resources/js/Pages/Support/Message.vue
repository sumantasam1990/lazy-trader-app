<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Message from '@/Components/Message.vue';
import {Link, router} from '@inertiajs/vue3'

defineProps({ tickets: Array })


function back() {
    window.history.back();
}

</script>

<template>
    <AppLayout title="Support">
        <template #header>
            <div>
                <Link @click="back" class="text-md text-blue-700 font-bold">&lt;Back</Link>
            </div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ticket Messages
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm sm:rounded-lg mt-3">
                    <Message :tickets="tickets" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
