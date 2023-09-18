<template>
    <Head><title>Create Community</title></Head>
    <Navbar/>
    <div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
        <div class="">
            <form @submit.prevent="createCommunity(community.id)" class="p-5">
                <h1 class="text-white text-2xl pb-5 text-center font-bold">Edit Community</h1>
                <div class="pb-5">
                    <div htmlFor="name" class="py-1 text-white">Name:</div>
                    <input type="text" id="name" v-model="form.name" :placeholder="community.name" class="rounded bg-[#515151] text-white">
                </div>
                <div class="pb-5">
                    <div htmlFor="description" class="py-1 text-white">Description:</div>
                    <textarea id="description" v-model="form.description" :placeholder="community.description" class="rounded bg-[#515151] w-96 text-white"></textarea>
                </div>
                <div class="pb-5">
                    <div htmlFor="rules" class="py-1 text-white">Rules:</div>
                    <textarea id="rules" v-model="form.rules" class="rounded bg-[#515151] w-96 text-white" :placeholder="community.rules"></textarea>
                </div>
                <div class="pb-5">
                    <div htmlFor="image" class="py-1 text-white">Image:</div>
                    <input type="file" id="image" @change="handleFileUpload" class="rounded bg-[#515151] text-white">
                </div>

                <div class="bg-[#CC0974] rounded-2xl inline-block">
                    <button type="submit" class="px-4 py-2">Create</button>
                </div>
                <a href="/">
                    <div class="border border-[#515151] rounded-2xl inline-block float-right">
                        <div class="px-4 py-2 text-white">Cancel</div>
                    </div>
                </a>
            </form>





    </div>


        <div class="p-5 py-10 mp-10">
            <h1 class="text-white text-2xl pb-5 text-center font-bold">Edit Flairs: </h1>
            <div htmlFor="name" class="py-1 pt-5 text-white">Flairs:</div>
            <div class="flex gap-2 py-2">
                <input type="text" id="flair-name" v-model="flairName" class="rounded bg-[#515151] text-white"/>
                <div class="bg-[#CC0974] rounded-2xl inline-block">
                    <button type="button" class="px-4 py-2" @click="createFlair()">Add</button>
                </div>
            </div>

            <div class="p-5 py-10 mp-10">
                <div v-for="flair in community.flairs">
                    <div class="py-2">
                        <div class="py-2 px-4 rounded-2xl bg-black text-white inline-block">
                            {{ flair.name }}
                            <span class="pl-2 text-sm hover:text-gray-500 cursor-pointer" @click="removeFlair(flair.id)">x</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>









    <div class="p-5 mp-10">
        <h1 class="text-white text-2xl pb-5 text-center font-bold">Edit Moderators: </h1>
        <div htmlFor="name" class="py-1 pt-5 text-white">Moderators:</div>
        <div class="flex gap-2 py-2">
            <input type="text" id="flair-name" v-model="moderatorName" class="rounded bg-[#515151] text-white"/>
            <div class="bg-[#CC0974] rounded-2xl inline-block">
                <button type="button" class="px-4 py-2" @click="addModerator()">Add</button>
            </div>
        </div>

        <div class="pb-5">
            <div v-for="moderator in moderators">
                <div class="py-2">
                    <div class="py-2 px-4 rounded-2xl bg-black text-white inline-block">
                        {{ moderator.user.name}}
                        <span class="pl-2 text-sm hover:text-gray-500 cursor-pointer" @click="deleteModerator(moderator.id)">x</span>
                    </div>
                </div>
            </div>
        </div>



        </div>
</div>

</template>

<script>
import axios from 'axios';
import { useForm, Head } from '@inertiajs/vue3';
import ApiUtilis from "@/Helpers/ApiUtilis";
import Navbar from "@/Components/Navbar/Navbar.vue";

export default {
    props:{
        community: Object,

    },
    components: {Navbar, Head},
    data(){
        return{
            showDiv: false,
            flairName: '',
            flairs : [],
            moderatorName: '',
            moderators: []
        };
    },
    setup() {
        const form = useForm({
            name: '',
            description: '',
            rules: '',
            image: '',
            flairs: []
        });

        const editForm = useForm({
            name: '',
            description: '',
            rules: '',
            flairs: []
        });

        const handleFileUpload = (event) => {
            const file = event.target.files[0];
            form.data.image = file;
            editForm.data.image = file;
        };

        const createCommunity = (id) => {
            form.post(route('communities.update', { id: id }), {
                onSuccess: () => {
                    // Handle success, e.g., redirect to communities index
                    // You can customize this based on your application's flow
                    console.log("I saved the community!")
                },
                onError: () =>{
                    // Handle error
                },
            });
        };

        return {

            form,
            handleFileUpload,
            createCommunity,
            editForm
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
        },
        createFlair() {
            const formData = {
                name: this.flairName,
                community_id: this.community.id,
            };
            ApiUtilis.createFlair(formData);
        },
        removeFlair(id){
            ApiUtilis.deleteFlair(id);
        },
        fetchFlairs(){
            this.flairs = ApiUtilis.fetchCommunityFlairs(this.community.id);
        },
        showEdit() {
            this.showDiv = !this.showDiv;
        },
        editCommunity(id) {
            ApiUtilis.editCommunity(id,this.editForm);
        },
        deleteFlair(id){
            ApiUtilis.deleteFlair(id);
        },
        editFlair(id){
            const formData = {
                name: this.flairName,
            };
            ApiUtilis.editFlair(id, formData);
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            this.form.image = file;
            this.editForm.image = file;
        },
        addModerator(){
            const formData = {
                name: this.moderatorName,
                community_id: this.community.id,
            };

            let moderator = ApiUtilis.createModerator(formData);
            this.moderators.push(moderator);
            this.fetchModerator();

        },
        deleteModerator(moderator){
            ApiUtilis.deleteModerator(moderator);
            this.fetchModerator();
        },
        async fetchModerator(){
            const response =   await  ApiUtilis.fetchModerators(this.community.id);
            this.moderators = response.data; // Assuming the API response is an array of moderators
        },
    },
    mounted() {
        this.fetchModerator();
    },
    created() {

        setInterval(() => {
            this.fetchModerator();
            this.fetchFlairs();
        }, 2000);

    }

};
</script>
