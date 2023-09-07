<template>
    <nav class="dark:bg-[#141414] relative">
        <div class="max-w-screen-xl flex flex-wrap  content-center items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center content-center m-auto">
                <ApplicationLogo class="w-32"/>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col md:p-0 rounded-lg md:flex-row md:mt-0">
                    <li class="w-64 absolute left-0 ml-5 -mb-10">
                        <div class="-mt-3">
                            <SearchIcon class="ml-2 w-5 mt-1.5 absolute"/>
                            <input type="text" class="rounded bg-[#2D2D2D] border-[#2D2D2D] w-64 h-8 pl-10 text-white"
                                   placeholder="Search topics"/>
                        </div>
                    </li>
                    <li>
                        <div class="-mt-3">
                            <div class="absolute right-0 grid grid-cols-2">
                                <div class="m-auto">
                                    <UserIcon class="w-7 inline-block"/>
                                    <span class="text-white px-2 mt-1.5">Username</span>
                                    <AngleDownIcon class="inline-block w-4"/>
                                </div>
                                <div class="mt-0.5 px-12">
                                    <SettingsIcon class="h-7"/>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

<!--            <div class="w-64 absolute left-0 ml-10">-->
<!--                <div class="relative">-->
<!--                    <SearchIcon class="ml-2 w-5 mt-1.5 absolute"/>-->
<!--                    <input type="text" class="rounded bg-[#2D2D2D] border-[#2D2D2D] w-64 h-8 pl-10 text-white"-->
<!--                           placeholder="Search topics"/>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="absolute right-0 grid grid-cols-2">-->
<!--                <div class="m-auto">-->
<!--                    <UserIcon class="w-7 inline-block"/>-->
<!--                    <span class="text-white px-2 mt-1.5">Username</span>-->
<!--                    <AngleDownIcon class="inline-block w-4"/>-->
<!--                </div>-->
<!--                <div class="mt-1 px-12">-->
<!--                    <SettingsIcon class="h-7"/>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </nav>

</template>

<script>
import ApplicationLogo from "@/Components/Icons/ApplicationLogo.vue";
import SearchIcon from "@/Components/Icons/SearchIcon.vue";
import UserIcon from "@/Components/Icons/UserIcon.vue";
import AngleDownIcon from "@/Components/Icons/AngleDownIcon.vue";
import SettingsIcon from "@/Components/Icons/SettingsIcon.vue";

export default {
    components: {SettingsIcon, AngleDownIcon, UserIcon, SearchIcon, ApplicationLogo}
}
</script>
