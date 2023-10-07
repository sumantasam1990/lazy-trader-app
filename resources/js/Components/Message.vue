<script setup>
import {Link, useForm} from '@inertiajs/vue3'
import TextArea from "@/Components/TextArea.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import {onMounted, ref} from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const { tickets } = defineProps(["tickets"]);

const form = useForm({
    message: null,
    child_id: tickets.user_id, // admin
    ticket_id: tickets.id ?? null,
})

const messageContainer = ref(null);

const scrollToBottom = () => {
    const container = messageContainer.value;
    if (container) {
        container.scrollTop = container.scrollHeight;
    };
};

onMounted(() => {
    scrollToBottom(); // Automatically scroll to the bottom when the component is mounted
});

const downloadFile = (url, fileName) => {
    const fullURL = url;

    const link = document.createElement('a');
    link.href = fullURL;
    link.target = '_blank';
    link.download = fileName;

    link.click();
};

</script>

<template>
    <div>
        <div class="p-2 lg:p-4 bg-white border-b border-gray-200 flex justify-between items-start">
            <div>
                <p class="text-sm font-medium">
                    Ticket: {{tickets.ticket_no}}
                </p>
                <h1 class="mt-2 text-lg font-medium text-gray-900">
                    {{tickets.title}}
                </h1>
                <p class="mt-2 text-sm font-medium text-gray-900">
                    {{tickets.message}}
                </p>
            </div>

<!--            <Dropdown :contentClasses="['py-1', 'bg-white']" :width="'48'" :align="'right'">-->
<!--                <template #trigger>-->
<!--                    <button class="py-2 px-2 text-white bg-black rounded">Status</button>-->
<!--                </template>-->
<!--                <template #content>-->
<!--                    <ul class="py-2 px-2">-->
<!--                        <li @click="selectStatus('Closed')">Closed</li>-->
<!--                        <li @click="selectStatus('In-Progress')">In-Progress</li>-->
<!--                    </ul>-->
<!--                </template>-->
<!--            </Dropdown>-->

            <div v-for="file in tickets.lazyfiles" :key="file.id">
                <SecondaryButton class="mt-4" type="button" @click="downloadFile(file.file_url, file.original_name)">Attachment</SecondaryButton>
            </div>

        </div>

        <div class="p-4">
            <div class="bg-white shadow-md rounded-md" style="" ref="messageContainer">
                <ul>
                    <li v-for="msg in tickets.messages" :key="msg.id" class="border-b border-gray-200 p-4 bg-white p-4 transform">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h6 class="text-sm flex items-center font-black font-medium">
                                        <img class="w-6 h-6 rounded-full object-cover mr-2" :src="'https://ui-avatars.com/api/?name=' + msg.parent.name[0] + msg.parent.name.slice(-1) + '&color=ffffff&background=000000'" alt="User Avatar">
                                        {{ msg.parent.name }}
                                    </h6>
                                    <p class="text-md mb-3 mt-2 ml-6">{{ msg.message }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mt-2">{{ msg.created_at }}</p>
                                </div>
                            </div>
                    </li>
                </ul>
            </div>
            <form @submit.prevent="form.post('/ticket/message/store')">
                <div class="mt-2">
                    <TextArea id="message" v-model="form.message" rows="6" class="w-full"></TextArea>
                </div>
                <div class="flex justify-between items-center">
                    <PrimaryButton class="h-10" :disabled="form.processing">
                        Reply
                    </PrimaryButton>

                </div>
            </form>
        </div>



    </div>
</template>

<style scoped>

</style>
