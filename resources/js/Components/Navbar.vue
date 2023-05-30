<template>
    <nav class="bg-white border-gray-200 dark:bg-[#141414] relative">
        <div class="w-2/3 flex flex-wrap  content-center items-center justify-between mx-auto p-4 relative">
            <a href="https://flowbite.com/" class="flex items-center content-center m-auto">
                <ApplicationLogo class="w-32"/>
            </a>
            <div class="w-64 absolute left-0">
                <div class="relative">
                    <SearchIcon class="ml-2 w-5 mt-1.5 absolute"/>
                    <input type="text" class="rounded bg-[#2D2D2D] border-[#2D2D2D] w-64 h-8 pl-10 text-white"
                           placeholder="Search topics"/>
                </div>
            </div>
            <div class="absolute right-0 -mr-32">
                <div class="m-auto">
                    <UserIcon class="w-7 inline-block"/>
                    <span class="text-white px-2 mt-1.5">Username</span>
                    <AngleDownIcon class="inline-block w-4"/>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import ApplicationLogo from "@/Components/Icons/ApplicationLogo.vue";
import SearchIcon from "@/Components/Icons/SearchIcon.vue";
import UserIcon from "@/Components/Icons/UserIcon.vue";
import AngleDownIcon from "@/Components/Icons/AngleDownIcon.vue";

export default {
    components: {AngleDownIcon, UserIcon, SearchIcon, ApplicationLogo}
}
</script>
