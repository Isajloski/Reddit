<template class="relative">
    <div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
        <div v-if="this.type==='home'" class="py-3 float-right" style="margin-top: -70px;">
            <Button>Following</Button>
        </div>
        <div class="px-1 md:px-10">
                    <CommunityCard v-if="this.type==='community'"
                    :name="this.community.name"
                    :type="'community'"
                    :active-users="community.activeUsers"
                    :total-users="community.totalUsers"
                    />
            <div class="md:py-10" v-for="array in posts">
                <div v-for="post in array" :key="post.id">
                    <Post :id="post.id"
                          :description="post.body"
                          :by-user="post.user.userName"
                          :community-name="post.community?.name"
                          :comments-number="post.comments_number"
                          :vote = "post.vote"
                          :karma="post.karma"
                          :date="post.date"
                          :image="post.image"
                          :title="post.title"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Button from "@/Components/Button/Button.vue";
import Post from "@/Components/Post/Post.vue";
import Comment from "@/Components/Comment/Comment.vue";
import Filter from "@/Components/Filter/Filter.vue";
import Create from "@/Pages/Home/Create.vue";
import CommunityCard from "@/Pages/Community/CommunityCard.vue";
import AboutCard from "@/Pages/Community/AboutCard.vue";
import ApiUtilis from "@/Helpers/ApiUtilis";

export default {
    name: "Content",
    components: {AboutCard, CommunityCard, Create, Filter, Post, Button, Comment},
    data() {
        return {
            data: [],
            posts: [],
            community: [],
            currentPage: 1,
        };
    },
    props : {
        type: String
    },
    mounted() {
        window.onscroll = () => {
            let bottomOfWindow =
                document.documentElement.scrollTop +
                window.innerHeight >= document.documentElement.offsetHeight - 200;

            if (bottomOfWindow) {
                this.currentPage = this.currentPage + 1;
                this.fetchData();
            }
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            if(this.type==='home'){
                try {
                    let response = await axios.get('/posts/paginate?page=' + this.currentPage);
                    const newData = response.data.data;
                    this.posts = [...this.posts, ...newData];
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }
            else if(this.type==='community'){
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
                    try {
                        let response = await axios.get(`/community/${result}/paginate?page=` + this.currentPage);
                        const newData = response.data.data;
                        this.posts = [...this.posts, ...newData];
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
                }
            }
        },
    },
}
</script>

<style scoped>
</style>
