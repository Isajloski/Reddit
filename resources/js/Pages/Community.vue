<script setup>
import {Head, Link} from '@inertiajs/vue3';
import Navbar from "@/Components/Navbar.vue";
import Filter from "@/Components/Filter.vue";
import Flairs from "@/Components/Flairs.vue";
import Create from "@/Components/Create.vue";
import Rules from "@/Components/Rules.vue";
import Content from "@/Layouts/Content.vue";
import AboutCard from "@/Components/AboutCard.vue";

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

