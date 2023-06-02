<template>
    <div class="w-full mx-auto z-0">
        <div class="py-5 px-7">
            <div class="grid grid-cols-2 relative">
                <div class="inline-block relative">
                    <TestIcon class="z-10 inline-block w-4 h-4"/>
                    <div class="ml-2 text-white inline-block">Photography</div>
                    <span class="text-xs ml-0.5 bottom-0 absolute text-[#898989] mb-1 font-light">/community</span>
                </div>
                <div class="inline-block text-right mr-20">
                    <span class="text-xs bottom-0 text-[#898989] mb-1 font-light">Posted by</span>
                    <span class="text-xs ml-1 bottom-0 absolute text-white mb-1">mimziphery</span>
                </div>
            </div>
            <div class="pt-3">
                <img class="object-cover w-full h-60 object-center rounded"
                    src="https://img.freepik.com/free-photo/beautiful-aerial-shot-fronalpstock-mountains-switzerland-beautiful-pink-blue-sky_181624-9315.jpg?w=1380&t=st=1685478210~exp=1685478810~hmac=1e718a3ae50f16e79ae05aa4a78ce930705b92631f89e1e35cc55ebf9c2b1e63"/>
            </div>
            <div class="px-2 pt-3">
                <div class="w-full grid grid-cols-2 relative">
                    <div>
                        <div class="inline-block mr-2">
                            <LikeIcon class="w-4 h-4 inline-block mx-1"/>
                            <div class="inline-block">
                                <span class="text-white text-sm">13.5K</span>
                                <span class="text-[#898989] text-xs font-light ml-1">likes</span>
                            </div>
                        </div>
                        <div class="inline-block">
                            <CommentIcon class="w-4 h-4 inline-block mx-1"/>
                            <div class="inline-block">
                                <span class="text-white text-sm">1.3K</span>
                                <span class="text-[#898989] text-xs font-light ml-1">comments</span>
                            </div>
                        </div>
                    </div>
                    <div class="right-0 absolute">
                        <ShareIcon class="w-4 h-4 inline-block"/>
                        <span class="mx-2 inline-block text-[#898989] text-xs font-light">Share</span>
                    </div>
                </div>
                <div class="py-2">
                    <p class="text-[#898989] pt-2 line-clamp-4 w-full">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse in nunc et lectus malesuada
                        tempus. Donec sollicitudin gravida nisi, quis suscipit nisl elementum eu. Vestibulum purus lectus,
                        ullamcorper non gravida nec, facilisis tincidunt lacus.Donec sollicitudin gravida nisi, quis suscipit nisl elementum eu. Vestibulum purus lectus,
                        ullamcorper non gravida nec, facilisis tincidunt lacus</p>
                    <p class="pt-1 text-white"> Expand post</p>
                </div>
            </div>
            <hr class="text-[#505050] border-[#505050] border-2"/>
        </div>
    </div>
</template>

<script>
import TestIcon from "@/Components/Icons/TestIcon.vue";
import LikeIcon from "@/Components/Icons/LikeIcon.vue";
import CommentIcon from "@/Components/Icons/CommentIcon.vue";
import ShareIcon from "@/Components/Icons/ShareIcon.vue";

export default {
    name: "Post",
    components: {ShareIcon, CommentIcon, LikeIcon, TestIcon},
    //or Post as an Object
    props: {
        id: String,
        community : String,
        user: String,
        likes: Number,
        title: String,
        comments: Number,
        photo: String,
        description: String
    }
}
</script>

<style scoped>

</style>
