<script setup>

import Dropdown from '@/Components/Dropdown/Dropdown.vue';
import InputError from '@/Components/Input/InputError.vue';
import PrimaryButton from '@/Components/Button/PrimaryButton.vue';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Posts from '@/Components/Post/Posts.vue';
import { useForm, Head } from '@inertiajs/vue3';


const props = defineProps(['posts']);

const form = useForm({
    message: props.posts.message,
});

const editing = ref(false);

</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('posts.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.message"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4">Post</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Posts
                    v-for="post in posts"
                    :key="post.id"
                    :post="post"
                />
            </div>



        </div>
    </AuthenticatedLayout>
</template>
