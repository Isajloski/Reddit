<template>
    <div class="container bg-gray-100">
        <div class="font-medium">
            <form @submit.prevent="createCommunity">
                <label htmlFor="name">Name:</label>
                <input type="text" id="name" v-model="form.name" placeholder="name">
                <br>

                <label htmlFor="description">Description:</label>
                <textarea id="description" v-model="form.description" placeholder="description" ></textarea>
                <br>

                <label htmlFor="rules">Rules:</label>
                <textarea id="rules" v-model="form.rules" ></textarea>
                <br>

                <label htmlFor="rules">Image:</label>
                <input  id="image" v-model="form.image" placeholder="image"  >
                <br>

                <button type="submit">Create Community</button>
            </form>
        </div>


        <div class="text-center self-center">
            <ul>
                <li v-for="community in communities" :key="community.id">
                    <h3>Community ID: {{ community.id }}</h3>
                    <h3>Owner: {{ community.user.name }}</h3>
                    <h3>E-mail Owner: {{community.user.email }}</h3>
                    <h3>r/{{ community.name }}</h3>
                    <p>description: {{ community.description }}</p>
                    <p>Rules: {{ community.rules }}</p>
                    <img :src="community.image" alt="Community Image" >
                    <form :action="route('communities.destroy', { id: community.id })" method="DELETE" style="display: inline;">

                        <button type="submit">Delete</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import {ref} from 'vue';
import { useForm, Head } from '@inertiajs/vue3';

export default {
    props:{
        communities: {
            type: Array,
            required: true,
        },
        error: 'True',
    },
    setup() {
        const form = useForm({
            name: '',
            description: '',
            rules: '',
            image: '',
        });

        const handleFileUpload = (event) => {
            const file = event.target.files[0];
            form.data.image = file;
        };

        const createCommunity = () => {
            form.post(route('communities.store'), {
                onSuccess: () => {
                    // Handle success, e.g., redirect to communities index
                    // You can customize this based on your application's flow
                    console.log("I saved the community!")
                },
                onError: () =>{
                    console.log("The /r/" + document.getElementById('text').toString().valueOf() + " already exsist!");
                },
            });
        };



        return {
            form,
            handleFileUpload,
            createCommunity,
        };


    },
};
</script>
