<template class="relative">
<div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
    <div class="py-3 float-right" style="margin-top: -70px;">
<!--        do not show button if its on subreddit-->
        <Button>Following</Button>
    </div>
    <div class="px-1 md:px-10">
        <CommunityCard/>
        <div class="py-5 md:py-16">
            <Post/>
            <Post/>
        </div>
    </div>
</div>
</template>

<script>
import Button from "@/Components/Button.vue";
import Post from "@/Components/Post.vue";
import Filter from "@/Components/Filter.vue";
import Create from "@/Components/Create.vue";
import CommunityCard from "@/Components/CommunityCard.vue";
import AboutCard from "@/Components/AboutCard.vue";
export default {
    name: "Content",
    components: {AboutCard, CommunityCard, Create, Filter, Post, Button}
}
</script>

<style scoped>

</style>
