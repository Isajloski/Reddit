<script setup>
import {Head, Link} from '@inertiajs/vue3';
import Navbar from "@/Components/Navbar/Navbar.vue";
import Filter from "@/Components/Filter/Filter.vue";
import Flairs from "@/Components/Flairs/Flairs.vue";
import Create from "@/Pages/Home/Create.vue";
import Rules from "@/Pages/Community/Rules.vue";
import Content from "@/Layouts/Content.vue";
import AboutCard from "@/Pages/Community/AboutCard.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Community"/>
    <Navbar/>
    <div id="left" class="absolute mt-32 md:mt-20 w-auto md:w-1/6 ml-5">
        <Filter class="rounded-xl"/>
        <Flairs class="my-3 hidden md:block"/>
    </div>
    <div id="right" class="absolute mt-10 md:mt-20 w-auto md:w-1/6 md:right-0 mx-5">
        <Create class="rounded-xl"/>
        <AboutCard class="my-3 hidden md:block"/>
        <Rules class="hidden md:block"/>
    </div>
    <Content/>
</template>

