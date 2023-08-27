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
                    <div htmlFor="image" class="py-1 text-white">Image:</div>
                    <input type="file" id="image" @change="handleFileUpload" class="rounded bg-[#515151] text-white">
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

                    <img v-if="community.image" :src="community.image.path" alt="Community Image">


                    <ul v-if="community.flairs != null">
                        <p>Flair</p>
                        <li v-for="flair in community.flairs" :key="flair.id">
                            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                              <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                  {{flair.name}}
                              </span>
                            </button>
                            <br/>
                            <div>
                                <form @submit.prevent="editFlair(flair.id)">
                                    <div>
                                        <label for="flair-name">New Flair Name</label>
                                        <input type="text" id="flair-name" v-model="flairName" />
                                    </div>
                                    <br/>
                                    <button type="submit"  class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
                                      <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                          EDIT FLAIR
                                      </span>
                                    </button>
                                </form>
                            </div>
                            <button @click="deleteFlair(flair.id)" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400">
                              <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                   DELETE
                              </span>
                            </button>


                        </li>
                    </ul>

                    <br/>
                    <br/>
                    <form @submit.prevent="createFlair(community.id)">
                        <div>
                            <label for="flair-name">Flair Name</label>
                            <input type="text" id="flair-name" v-model="flairName" />
                        </div>
                        <br/>
                        <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400">
                                      <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                           CREATE NEW FLAIR
                                      </span>
                        </button>
                    </form>

                    <br/>
                    <br/>

                    <button class="text-white bg-emerald-500 py-2 px-5 rounded" @click="deleteCommunity(community.id)">Delete</button>
                    <br/>
                    <br/>
                        <button class="text-white bg-emerald-500 py-2 px-4 rounded" @click="showEdit">Edit</button>
                    <br/>
                    <br/>






                    <div v-if="showDiv">
                        <div class="font-medium">
                            <form @submit.prevent="editCommunity(community.id)">

                                <label htmlFor="name">Name:</label>
                                <input type="text" id="name" v-model="editForm.name" :placeholder="community.name">
                                <br>

                                <label htmlFor="description">Description:</label>
                                <textarea id="description" v-model="editForm.description" :placeholder="community.description" ></textarea>
                                <br>

                                <label htmlFor="rules">Rules:</label>
                                <textarea id="rules" :placeholder="community.rules"  v-model="editForm.rules" ></textarea>
                                <br>


                                <button class="text-white bg-red-400 py-2 px-5 rounded" type="submit">Change the settings</button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
import { useForm, Head } from '@inertiajs/vue3';
import ApiUtilis from "@/Helpers/ApiUtilis";
import Navbar from "@/Components/Navbar/Navbar.vue";
export default {
    components: {Navbar},
    data(){
        return{
            showDiv: false,
            flairName: ''
        };
    },
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

        const editForm = useForm({
            name: '',
            description: '',
            rules: '',
        });

        const handleFileUpload = (event) => {
            const file = event.target.files[0];
            form.data.image = file;
            editForm.data.image = file;
        };

        const createCommunity = () => {
            console.log(form)
            form.post(route('communities.store'), {
                onSuccess: () => {
                    // Handle success, e.g., redirect to communities index
                    // You can customize this based on your application's flow
                    console.log("I saved the community!")
                },
                onError: () =>{
                    // console.log("The /r/" + document.getElementById('text').toString().valueOf() + " already exsist!");
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
        showEdit() {
            this.showDiv = !this.showDiv;
        },
        editCommunity(id) {
            ApiUtilis.editCommunity(id,this.editForm);
        },
        deleteFlair(id){
            ApiUtilis.deleteFlair(id);
        },
        createFlair(id) {
            const formData = {
                name: this.flairName,
                community_id: id,
            };
            ApiUtilis.createFlair(formData);
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
        }


    }

};
</script>
