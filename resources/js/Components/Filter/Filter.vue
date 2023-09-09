<template>
<div class="py-2 md:py-5 bg-[#2D2D2D]">
    <div class="flex flex-row flex-wrap ">
        <div class="pl-0 md:pl-5 pr-0 md:pr-7 text-[#898989] text-sm mt-2.5 font-light hidden lg:block">Sort <span class="hidden xl:block">posts</span></div>
        <div class="lg:absolute lg:right-0 flex flex-row">
        <a class="cursor-pointer" @click="activateTopPosts()">
            <div class="px-5">
                <TopIcon class="h-5" :active="topPosts"/>
                <div class=" lg:pt-2 text-xs font-light" :class="{'text-white' : topPosts, 'text-gray-500' : !topPosts}">Top</div>
            </div>
        </a>
        <a class="cursor-pointer" @click="activateNewestPosts()">
            <div class="px-5">
                <NewIcon class="h-5" :active="newPosts"/>
                <div class="lg:pt-2 text-xs font-light" :class="{'text-white' : newPosts, 'text-gray-500' : !newPosts}">New</div>
            </div>
        </a>
    </div>
    </div>
</div>
</template>

<script>
import TopIcon from "@/Components/Icons/TopIcon.vue";
import NewIcon from "@/Components/Icons/NewIcon.vue";
export default {
    name: "Filter",
    components: {NewIcon, TopIcon},
    data() {
        return {
            newPosts: Boolean,
            topPosts: Boolean
        }
    },
    emits: ['sort'],
    created() {
        this.newPosts = true;
        this.topPosts = false;
    },
    methods: {
        activateTopPosts(){
            this.topPosts = true;
            this.newPosts = false;
            this.sortEmmiter();
        },
        activateNewestPosts(){
            this.topPosts = false;
            this.newPosts = true;
            this. sortEmmiter();
        },
        sortEmmiter(){
            if(this.topPosts){
                this.$emit('sort', 'top');
            }
            if(this.newPosts){
                this.$emit('sort', 'new');
            }
        }
    }
}
</script>

<style scoped>

</style>
