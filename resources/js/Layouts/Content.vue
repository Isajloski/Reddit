<template class="relative">
    <Filter class="absolute mt-32 md:mt-20 rounded-xl w-auto md:w-1/6 ml-5"/>
    <Create class="absolute mt-10 md:mt-20 rounded-xl w-auto md:w-1/6 md:right-0 mx-5"/>
<div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
    <div class="py-3 float-right" style="margin-top: -70px;">
        <Button>Following</Button>
    </div>
    <div class="px-1 md:px-10 py-5 md:py-16">
        <Post/>
        <Post/>
    </div>
</div>
</template>

<script>
import Button from "@/Components/Button.vue";
import Post from "@/Components/Post.vue";
import Filter from "@/Components/Filter.vue";
import Create from "@/Components/Create.vue";
export default {
    name: "Content",
    components: {Create, Filter, Post, Button}
}
</script>

<style scoped>

</style>
