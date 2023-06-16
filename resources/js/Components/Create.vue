<template>
<div class="bg-[#2D2D2D] inline-block">
    <div class="flex flex-col px-0 md:px-5 z-0">
        <div class="px-5 md:px-1 lg:px-5 py-3 inline-block">
            <a href="/makePost"><div class="text-white inline-block pr-4 text-sm md:text-base">Make a new post</div><PlusIcon class="inline-block"/></a>
        </div>
        <div class="px-5 md:px-1 lg:px-5 pb-3 inline-block">
            <a href="/makeCommunity"><div class="text-white inline-block pr-4 text-sm md:text-base">Make a new community</div><PlusIcon class="inline-block"/></a>
        </div>
    </div>
    <WhiteSmallLogo class=" hidden md:block z-10 absolute top-0 right-0 -mt-5 -mr-3"/>
</div>
</template>

<script>
import PlusIcon from "@/Components/Icons/PlusIcon.vue";
import WhiteSmallLogo from "@/Components/Icons/WhiteSmallLogo.vue";
export default {
    name: "Create",
    components: {WhiteSmallLogo, PlusIcon}
}
</script>

<style scoped>

</style>
