<template>
<div class="py-2 md:py-5 bg-[#2D2D2D]">
    <div class="flex flex-row flex-wrap ">
        <div class="pl-0 md:pl-5 pr-0 md:pr-7 text-[#898989] text-sm mt-2.5 font-light hidden lg:block">Sort <span class="hidden xl:block">posts</span></div>
        <div class="lg:absolute lg:right-0 flex flex-row">
        <div class="px-5">
            <TopIcon class="h-5"/>
            <div class="text-white lg:pt-2 text-xs font-light">Top</div>
        </div>
        <div class="px-5">
            <NewIcon class="h-5"/>
            <div class="text-gray-500 lg:pt-2 text-xs font-light">New</div>
        </div>
    </div>
    </div>
</div>
</template>

<script>
import TopIcon from "@/Components/Icons/TopIcon.vue";
import NewIcon from "@/Components/Icons/NewIcon.vue";
export default {
    name: "Filter",
    components: {NewIcon, TopIcon}
}
</script>

<style scoped>

</style>
