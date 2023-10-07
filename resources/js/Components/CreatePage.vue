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
    content: null,
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
            Create a page
        </template>

        <template #description>
            Create your custom page with upto 10 images.
        </template>

        <template #form>

            <!-- Title -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Page Title" />
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="title"
                />
                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <!-- Message -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Page Content" />
                <TextArea
                    id="message"
                    v-model="form.content"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="message"
                />
                <InputError :message="form.errors.content" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="w-64 mt-4">
                    <label for="file-upload" class="block text-gray-700 text-sm font-bold mb-2">
                        Choose image: (Optional)
                    </label>
                    <label
                        class="w-full flex flex-row items-center px-4 py-6 bg-white rounded-md shadow-md tracking-wide uppercase cursor-pointer hover:bg-blue-300 hover:text-white"
                    >
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABZUlEQVR4nO3XQUoDMRiG4ddxpbjpGfQCRQXxcFWLXSp2Nq7qEerCnXvxEM4pVMTCwC8DEUKw2iH5kwnmgyxappnvaTOdDJSUlGySXWAKNEALSI9hpyJR+eeepdcBFikQU4/yLkBSIJrAgOiIVgEQFSFKgG7cxUBoAiQGQhsg2ogYANFExAKIFiImQDQQvoBta67Vhp9ZhET4AvatuWYpEOI5JiFKpAR8AKdkDBCDOAcOnGsiG4DP8E4BUH4Bv5QlxD9bQvfAMTACTnIDXIconApwZc7X7X9q4B2Yh9gPxfzmt4Db0NvrlOUlBCJ1efFFaJV/6FHeC6EFODTz1z88yPz2uh4KYM/M/+aUrZzjKgfxOhTAkfWY2f1l3ljLwz4O8/7cHHc5FMCjWf9/ndM7ojiWwNhsG8Y5AmRN2aCANndAkzvgInfADvCUM+AbcQa8KF8TaoDYWZnyn2Samdli9L7rlhA5X2BWIDlDOlRUAAAAAElFTkSuQmCC" alt="icon">
                        <span class="mt-2 text-base leading-normal font-semibold text-black">Select images</span>
                        <input
                            @input="form.avatars = $event.target.files"
                            type="file"
                            id="file-upload"
                            class="hidden"
                            multiple
                        />
                    </label>
                </div>

                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Created.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Create
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
