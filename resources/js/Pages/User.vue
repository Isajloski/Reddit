<template>
    <Head :title="user[0].name" ></Head>
    <Navbar :user="user"/>
    <div id="left" class="absolute mt-32 md:mt-6 w-auto md:w-1/6 ml-5">
        <Filter class="rounded-xl" @sort="emitSortType($event)"/>
    </div>
    <div id="right" class="absolute mt-10 md:mt-6 w-auto md:w-1/6 md:right-0 mx-5">
        <ProfileCard :user="user[0]"/>
    </div>
    <Content :type="'user'" :sort="this.sort"/>
</template>

<script>

import Navbar from "@/Components/Navbar/Navbar.vue";
import Filter from "@/Components/Filter/Filter.vue";
import Create from "@/Pages/Home/Create.vue";
import ProfileCard from "@/Components/User/ProfileCard.vue";
import Content from "@/Layouts/Content.vue";
import { Head } from '@inertiajs/vue3';
export default {
    name: "User",
    components: {ProfileCard, Navbar,Filter,Create,Content, Head},
    data() {
      return {
          sort: "new"
      }
    },
    props: {
        user: Object,
        posts: Array,
    },
    created() {
        document.title = this.user[0].name;
    },
    methods : {
        emitSortType(sort){
            this.sort = sort;
        }
    }
}
</script>

<style scoped>

</style>
