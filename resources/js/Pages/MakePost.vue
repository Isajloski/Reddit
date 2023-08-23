<template>
    <Navbar/>
    <div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
        <div class="">
            <h1 class="text-white text-2xl pb-5 text-center font-bold">Create Post</h1>
            <form class="p-5" @submit.prevent="createPost">
                <div class="pb-5">
                    <div htmlFor="name" class="py-1 text-white">Community</div>
                    <Dropdown
                        placeholder="Select"
                        :options="dropdownOptions"
                        @option-selected="handleSelectedOption"
                        v-model="form.communityId"></Dropdown>
<!--                    <input type="text" id="communityId" v-model="form.communityId" class="rounded bg-[#515151] text-white">-->
                </div>
                <div class="pb-5">
                    <div htmlFor="" class="py-1 text-white">Title:</div>
                    <input type="text" id="title" v-model="form.title" class="rounded bg-[#515151] text-white w-full">
                </div>
                <div class="pb-5">
                    <div htmlFor="" class="py-1 text-white">Content:</div>
                    <textarea type="text" id="content" v-model="form.body" class="rounded bg-[#515151] w-96 text-white w-full"></textarea>
                </div>
                <div class="pb-5">
                    <div class="py-1 text-white">Image:</div>
                    <input type="text" id="image"  @change="handleFileUpload" class="rounded bg-[#515151] text-white">
                </div>
                <div class="pb-5">
                    <div class="py-1 text-white">Link:</div>
                    <input type="text" id="link" class="rounded bg-[#515151] text-white">
                </div>
                <div class="bg-[#CC0974] rounded-2xl inline-block">
                    <button type="submit" class="px-4 py-2">Create</button>
                </div>
                <div class="border border-[#515151] rounded-2xl inline-block float-right">
                    <button type="button" class="px-4 py-2 text-white">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Navbar from "@/Components/Navbar/Navbar.vue";
import {useForm} from "@inertiajs/vue3";
import Dropdown from '@/Components/Dropdown/Dropdown.vue';
import ApiUtilis from "@/Helpers/ApiUtilis";

export default {
    name: "MakePost",
    components: {Dropdown, Navbar},
    data(){
        return {
            dropdownOptions: [],
            selectedOptionInParent: null,
        }
    },
    async created() {
        try {
            // Fetch options from an API
            const response  = await ApiUtilis.fetchUserCommunities();
            this.dropdownOptions = response.data; // Set the fetched options
        } catch (error) {
            console.error('Error fetching options:', error);
        }
    },
    setup(){

        const form = useForm({
            communityId: '',
            title: '',
            body: '',
            image: ''
        })

        const handleFileUpload = (event) => {
            form.data.image = event.target.files[0];
        };

        const createPost = () => {
            console.log(form)
            form.post(route('posts.create'), {
                onSuccess: () => {
                    // Handle success, e.g., redirect to communities index
                    // You can customize this based on your application's flow
                    console.log("I saved the post!")
                },
                onError: () =>{
                    console.log("error");
                },
            });
        }

        return {
            form,
            handleFileUpload,
            createPost
        }
    },
    methods: {
        handleSelectedOption(option){
            this.selectedOptionInParent = option;
        }
    }
}
</script>

<style scoped>

</style>
