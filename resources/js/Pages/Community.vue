<script>
import {Head} from '@inertiajs/vue3';
import Navbar from "@/Components/Navbar/Navbar.vue";
import Filter from "@/Components/Filter/Filter.vue";
import Flairs from "@/Components/Flairs/Flairs.vue";
import Create from "@/Pages/Home/Create.vue";
import Rules from "@/Pages/Community/Rules.vue";
import Content from "@/Layouts/Content.vue";
import AboutCard from "@/Pages/Community/AboutCard.vue";
import CommunityCard from "@/Pages/Community/CommunityCard.vue";
import Post from "@/Components/Post/Post.vue";
import Button from "@/Components/Button/Button.vue";
import Comment from "@/Components/Comment/Comment.vue";
import ApiUtilis from "@/Helpers/ApiUtilis";


export default {
    name: "Community",
    components: {AboutCard, CommunityCard, Create, Filter, Post, Button, Comment, Flairs, Rules, Navbar, Head, Content},
    data() {
        return {
            community: Object,
            sort: 'new'
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        async fetchData(){
            const regexPattern = /[^/]+$/;

            const path = window.location.pathname;
            const match = path.match(regexPattern);

            if (match) {
                const result = match[0];
                try {
                    let response = await ApiUtilis.fetchCommunity(result);
                    this.community = response.data[0];
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }
        },
        emitSortType(sort){
            this.sort = sort;
        }
    }
}
</script>

<template>
    <Head title="Community"><title></title></Head>
    <Navbar/>
    <div id="left" class="absolute mt-32 md:mt-20 w-auto md:w-1/6 ml-5">
        <Filter class="rounded-xl" @sort="emitSortType($event)"/>
        <Flairs class="my-3 hidden md:block"/>
    </div>
    <div id="right" class="absolute mt-10 md:mt-20 w-auto md:w-1/6 md:right-0 mx-5">
        <Create class="rounded-xl"/>
        <AboutCard class="my-3 hidden md:block"
                   :about="community.about"
        />
        <Rules class="hidden md:block"
               :rules="community.rules"
        />
    </div>
    <Content :type="'community'" :sort="this.sort"/>
</template>

