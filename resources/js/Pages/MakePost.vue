<template>
    <Navbar/>
    <div class="w-auto md:w-3/5 mx-5 md:mx-auto mt-48 md:mt-20 rounded-xl relative bg-[#2d2d2d]">
        <div class="">
            <h1 class="text-white text-2xl pb-5 text-center font-bold">Create Post</h1>
            <form class="p-5">
                <div class="pb-5">
                    <div htmlFor="name" class="py-1 text-white">Community</div>
                    <input type="text" id="community" class="rounded bg-[#515151] text-white">
                </div>
                <div class="pb-5">
                    <div htmlFor="" class="py-1 text-white">Title:</div>
                    <input type="text" id="title" class="rounded bg-[#515151] text-white w-full">
                </div>
                <div class="pb-5">
                    <div htmlFor="" class="py-1 text-white">Content:</div>
                    <textarea type="text" id="content" class="rounded bg-[#515151] w-96 text-white w-full"></textarea>
                </div>
                <div class="pb-5">
                    <div class="py-1 text-white">Image:</div>
                    <input type="text" id="image" class="rounded bg-[#515151] text-white">
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
import Navbar from "@/Components/Navbar.vue";
export default {
    name: "MakePost",
    components: {Navbar}
}
</script>

<style scoped>

</style>
