<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CreatePage from "@/Components/CreatePage.vue";

</script>

<template>
    <AppLayout title="Create a new ticket">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Page
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div>
                    <CreatePage :user="$page.props.auth.user" />

                </div>


            </div>
        </div>
    </AppLayout>
</template>
