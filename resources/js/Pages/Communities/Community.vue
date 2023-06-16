<template>
    <Navbar/>
    <div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
        <div class="">
            <form @submit.prevent="createCommunity" class="p-5">
                <h1 class="text-white text-2xl pb-5 text-center font-bold">Create Community</h1>
                <div class="pb-5">
                    <div htmlFor="name" class="py-1 text-white">Name:</div>
                    <input type="text" id="name" v-model="form.name" placeholder="name" class="rounded bg-[#515151] text-white">
                </div>
                <div class="pb-5">
                    <div htmlFor="description" class="py-1 text-white">Description:</div>
                    <textarea id="description" v-model="form.description" placeholder="description" class="rounded bg-[#515151] w-96 text-white"></textarea>
                </div>
                <div class="pb-5">
                    <div htmlFor="rules" class="py-1 text-white">Rules:</div>
                    <textarea id="rules" v-model="form.rules" class="rounded bg-[#515151] w-96 text-white"></textarea>
                </div>
                <div class="pb-5">
                    <div htmlFor="rules" class="py-1 text-white">Image:</div>
                    <input  id="image" v-model="form.image" placeholder="image"  class="rounded bg-[#515151] text-white">
                </div>
                <div class="bg-[#CC0974] rounded-2xl inline-block">
                    <button type="submit" class="px-4 py-2">Create</button>
                </div>
                <div class="border border-[#515151] rounded-2xl inline-block float-right">
                    <button type="button" class="px-4 py-2 text-white">Cancel</button>
                </div>
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

                    <button @click="deleteCommunity(community.id)">Delete</button>
                    <button>Edit</button>

                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { useForm, Head } from '@inertiajs/vue3';
import Navbar from "@/Components/Navbar.vue";

export default {
    components: {Navbar},
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

    methods: {
        deleteCommunity(id) {
            if (confirm('Are you sure you want to delete this community?')) {
                axios.post(`/communities/${id}/delete`)
                    .then(response => {
                        // Handle successful deletion, e.g., update UI or show success message
                        console.log('Community deleted successfully!');
                    })
                    .catch(error => {
                        // Handle error case, e.g., show error message
                        console.error('Error deleting community:', error);
                    });
            }
        }
    }

};
</script>
