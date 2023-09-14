<template>
<div class="flex flex-row pt-10">
    <img class="w-32 h-32 object-cover rounded border-2 border-white mx-5 md:mx-0" src="https://upload.wikimedia.org/wikipedia/commons/f/f9/Misha-Mansoor.jpg">
    <div class="px-2 md:px-10">
        <div class="my-auto text-2xl md:text-7xl font-bold text-[#F20085] line-clamp-2">{{ name }}<span class="px-2 text-white text-base md:text-3xl font-normal">/{{ type }}</span></div>
        <div class="flex flex-row pt-2">
            <svg  class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512"><path fill="pink" d="M12,17c-2.76,0-5-2.24-5-5s2.24-5,5-5,5,2.24,5,5-2.24,5-5,5Z"/></svg>
            <div class="text-white font-light text-[10px] text-xs mx-1">{{ activeUsers }} Active Users</div>
            <svg  class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512"><path fill="pink" d="M12,17c-2.76,0-5-2.24-5-5s2.24-5,5-5,5,2.24,5,5-2.24,5-5,5Z"/></svg>
            <div class="text-white font-light text-[10px] text-xs mx-1">{{ totalUsers }} Total Users</div>
        </div>
        <div class="pt-2">
            <div class="bg-[#CC0974] rounded-2xl inline-block">
                <button type="submit" class="px-4 py-1" @click="following? unfollowCommunity() : followCommunity()">
                    {{following ? 'Following' : 'Follow'}}
                </button>
            </div>
        </div>
    </div>
</div>
    <hr class="mt-10 w-1/3 border-2 border-[#505050] mx-auto rounded"/>
</template>

<script>
import ApiUtilis from "@/Helpers/ApiUtilis";

export default {
    name: "CommunityCard",
    data () {
        return {
            following: ''
        }
    },
    props : {
        name: String,
        type: String,
        id: Number,
        totalUsers: Number,
        activeUsers: Number
    },
    watch: {
        id(newVal){
            this.fetchIfUserIsFollowing();
        },
        following(newVal){
            this.following = newVal;
        }
    },
    methods: {
        async fetchIfUserIsFollowing() {
            try {
                let response = await ApiUtilis.fetchUserFollowingCommunity(this.id);
                this.following = response.data.length !== 0;
            } catch (error) {

            }
        },
        async followCommunity(){
            try {
                let response = await ApiUtilis.followCommunity(this.id);
                this.following = !this.following;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        },
        async unfollowCommunity(){
            try {
                let response = await ApiUtilis.unfollowCommunity(this.id);
                this.following = !this.following;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }
    }
}
</script>

<style scoped>

</style>
