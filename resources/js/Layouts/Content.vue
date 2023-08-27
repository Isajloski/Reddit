<template class="relative scrollable-container" ref="scrollContainer" @scroll="handleScroll">
<div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
    <div class="py-3 float-right" style="margin-top: -70px;">
<!--        do not show button if its on subreddit-->
<!--        <Button>Following</Button>-->
    </div>
    <div class="px-1 md:px-10">
<!--        <CommunityCard/>-->
        <div class="md:py-10" v-for="(post) in posts" :key="post.id">
            <Post :id="post.id"
                  :description="post.body"
                  :by-user="post.user"
                  :community-name="post.community?.name"
                  :comments="post.comments_number"
                  :karma="post.karma"
                  :date="post.date"
                  :image="post.image"
                  :title="post.title"
            />
        </div>
    </div>
</div>
</template>

<script>
import Button from "@/Components/Button/Button.vue";
import Post from "@/Components/Post/Post.vue";
import Filter from "@/Components/Filter/Filter.vue";
import Create from "@/Pages/Home/Create.vue";
import CommunityCard from "@/Pages/Community/CommunityCard.vue";
import AboutCard from "@/Pages/Community/AboutCard.vue";
export default {
    name: "Content",
    components: {AboutCard, CommunityCard, Create, Filter, Post, Button},
    data() {
        return {
            posts: [],
            currentPage: 1,
        };
    },
    mounted() {
        // this.fetchData();
    },
    created() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                let newData = [await axios.get('/posts/paginate/' + this.currentPage)]; // Fetch data using your method here
                const dataD = await newData[0].data;
                console.log(dataD)
                this.posts.push(dataD);
                // this.posts = [...this.posts, ...response];
                // const response = await axios.get('/posts/recent');
                // this.posts = response.data;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        },

    },
}
</script>

<style scoped>

</style>
