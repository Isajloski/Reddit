<template>
    <Head><title>Create Post</title></Head>
    <Navbar/>
    <div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
        <div class="">
            <h1 class="text-white text-2xl pb-5 text-center font-bold">Create Post</h1>
            <form class="p-5" @submit.prevent="createPost" enctype="multipart/form-data" >
                <div class="pb-5">
                    <div htmlFor="name" class="py-1 text-white">Community</div>
                    <Dropdown
                        placeholder="Select"
                        :options="communityOptions"
                        @option-selected="handleSelectedCommunity"
                        id="communityId"
                        v-model="form.communityId"></Dropdown>
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
                    <div htmlFor="image" class="py-1 text-white">Image:</div>
                    <input type="file" name="image" id="image" @change="onFileChange" class="rounded bg-[#515151] text-white">
                </div>

<!--                <div class="pb-5">-->
<!--                    <div class="py-1 text-white">Link:</div>-->
<!--                    <input type="text" id="link" class="rounded bg-[#515151] text-white">-->
<!--                </div>-->

                <div class="pb-5">
                    <div class="py-1 text-white">Mark as spoiler:</div>
                    <input type="checkbox" id="spoiler" @click="form.spoiler = !form.spoiler" class="bg-black">
                </div>

                <div class="pb-5">
                    <div htmlFor="flair" class="py-1 text-white">Flair</div>
                    <Dropdown
                        placeholder="Select"
                        :options="flairOptions"
                        @option-selected="handleSelectedFlair"
                        id="flairId"
                        v-model="form.flair"></Dropdown>
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
    </div>
</template>

<script>
import Navbar from "@/Components/Navbar/Navbar.vue";
import {useForm, Head} from "@inertiajs/vue3";
import Dropdown from '@/Components/Dropdown/Dropdown.vue';
import ApiUtilis from "@/Helpers/ApiUtilis";



export default {
    name: "MakePost",
    components: {Dropdown, Navbar, Head},
    data(){
        return {
            communityOptions: [],
            flairOptions: [],
            selectedCommunity: null,
        }
    },
    async created() {
        try {
            const response  = await ApiUtilis.fetchUserCommunities();
            this.communityOptions = response.data;
        } catch (error) {
            console.error('Error fetching options:', error);
        }
    },
    setup(){
        const form = useForm({
            communityId: '',
            title: '',
            body: '',
            image: null,
            flair: '',
            spoiler: false
        })
        const createPost = () => {
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
            createPost
        }
    },
    methods: {
        handleSelectedCommunity(option){
            this.selectedCommunity = option;
            this.form.communityId = option;
            this.fetchFlairs();
        },
        handleSelectedFlair(option){
            this.form.flair = option;
        },
        async fetchFlairs(){
            try {
                const response  = await ApiUtilis.fetchCommunityFlairs(this.form.communityId);
                this.flairOptions = response.data;
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        onFileChange(event) {
            this.form.image = event.target.files[0];
        }
    }
}
</script>

<style scoped>

</style>
