<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import FormSection from "@/Components/FormSection.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {reactive} from "vue";
import {router, useForm} from "@inertiajs/vue3";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'POST',
    title: null,
    message: null,
    avatars: null,
});

const createTicket = () => {
    // if (photoInput.value) {
    //     form.photo = photoInput.value.files[0];
    // }

    form.post(route('support.ticket.store'), {
        forceFormData: true,
        errorBag: 'createTicket',
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <FormSection @submitted="createTicket">
        <template #title>
            Create your issue
        </template>

        <template #description>
            Share your issue or feedback to us. We will contact you within 24 hours.
        </template>

        <template #form>

            <!-- Title -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Title" />
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="title"
                />
                <InputError :message="form.errors.message" class="mt-2" />
            </div>

            <!-- Message -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Message" />
                <TextArea
                    id="message"
                    v-model="form.message"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="message"
                />
                <InputError :message="form.errors.message" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Message" />
                <input type="file" @input="form.avatars = $event.target.files" multiple />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>

<!--<template>-->
<!--    <form @submit.prevent="submit">-->
<!--        <label for="first_name">First name:</label>-->
<!--        <input id="first_name" v-model="form.first_name" />-->
<!--        <label for="last_name">Last name:</label>-->
<!--        <input id="last_name" v-model="form.last_name" />-->
<!--        <label for="email">Email:</label>-->
<!--        <input id="email" v-model="form.email" />-->
<!--        <button type="submit">Submit</button>-->
<!--    </form>-->
<!--</template>-->

<style scoped>

</style>
