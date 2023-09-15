<template class="relative">
    <div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
        <div v-if="this.type==='home'" class="py-3 float-right" style="margin-top: -70px;">
            <Dropdown :options="[{id: 'following', name: 'Following'},{id: 'trending', name: 'Trending'}]"
                      :placeholder="this.filter" @option-selected="handleFilter($event)"
            />
        </div>
        <div class="px-1 md:px-10">
                    <CommunityCard v-if="this.type==='community'"
                    :name="this.community.name"
                    :id="this.community.id"
                    :type="'community'"
                    :active-users="community.activeUsers"
                    :total-users="community.totalUsers"
                    />
            <div class="md:py-10" v-for="post in posts">
                <Post :id="post.id"
                      :description="post.body"
                      :by-user="post.user?.userName"
                      :community-name="post.community?.name"
                      :community-id="post.community?.id"
                      :comments-number="post.comments_number"
                      :vote = "post.vote"
                      :karma="post.karma"
                      :date="post.date"
                      :image="post.image"
                      :title="post.title"
                      :flair="post.flair"
                      @deleteEmitter="handleDeletePost($event)"

                />
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
import Dropdown from "@/Components/Dropdown/Dropdown.vue";

export default {
    name: "Content",
    components: {Dropdown, AboutCard, CommunityCard, Create, Filter, Post, Button, Comment},
    data() {
        return {
            data: [],
            posts: [],
            community: [],
            currentPage: 1,
            filter: 'Following',
        };
    },
    props : {
        type: String,
        sort: String,
        flair: String | Number
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
    watch: {
        sort(newVal){
            this.currentPage = 1;
            this.posts = [];
            this.fetchData();
        },
        filter(newVal){
            this.currentPage = 1;
            this.posts = [];
            this.fetchData();
        },
        flair(newVal){
            this.currentPage = 1;
            if(this.flair.length===0){
                this.posts=[];
                return this.fetchData();
            }
            else{
                this.posts = this.posts.filter(post => {
                    if(post.flair){
                        return post.flair.id === this.flair
                    }
                    else return false;
                });
            }
        }
    },
    methods: {
        handleFilter(option){
            this.filter = option;
        },
        async fetchData() {
            const sortDto = {
                sort: this.sort,
            }
            if(this.type==='home'){

                if(this.filter.toLowerCase() === 'following'){
                    try {
                        let response = await ApiUtilis.getPaginatedFollowingPosts(this.currentPage, sortDto);
                        const newData = response.data.data;
                        this.posts = [...this.posts, ...newData];
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
                }
                else {
                    try {
                        let response = await ApiUtilis.getPaginatedTrendingPosts(this.currentPage, sortDto);
                        const newData = response.data.data;
                        this.posts = [...this.posts, ...newData];
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
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
                        let response = await ApiUtilis.fetchCommunityPosts(result, this.currentPage, sortDto)
                        const newData = response.data.data;
                        this.posts = [...this.posts, ...newData];
                    } catch (error) {
                         console.error('Error fetching data:', error);
                    }
                }
            }
            else if(this.type === 'user'){
                const regexPattern = /[^/]+$/;

                const path = window.location.pathname;
                const match = path.match(regexPattern);

                if (match) {
                    const userName = match[0];
                    try {
                        let response = await ApiUtilis.fetchUserPosts(userName, this.currentPage, sortDto);
                        const newData = response.data.data;
                        this.posts = [...this.posts, ...newData];

                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
                }
            }
        },
        handleDeletePost(postId){
            const index = this.posts.findIndex(post => post.id === postId);
            if (index !== -1) {
                this.posts.splice(index, 1);
            }
        }
    },
}
</script>

<style scoped>
</style>
