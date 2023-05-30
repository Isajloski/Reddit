<template>
<div class="w-2/3 mx-auto mt-20 rounded relative bg-[#2d2d2d]">
    <div class="py-3 float-right" style="margin-top: -70px;">
        <Button>Following</Button>
    </div>
    <div class="px-10 py-16">
        <Post/>
        <Post/>
    </div>
</div>
</template>

<script>
import Button from "@/Components/Button.vue";
import Post from "@/Components/Post.vue";
export default {
    name: "Content",
    components: {Post, Button}
}
</script>

<style scoped>

</style>
