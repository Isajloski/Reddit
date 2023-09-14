<template>
    <Head :title="user[0].name" ></Head>
    <Navbar :user="user"/>
    <div id="left" class="absolute mt-32 md:mt-6 w-auto md:w-1/6 ml-5">
        <Filter class="rounded-xl"/>
    </div>
    <div id="right" class="absolute mt-10 md:mt-6 w-auto md:w-1/6 md:right-0 mx-5">
        <ProfileCard :user="user[0]"/>
    </div>
    <Content :type="user" :sort="this.sort"/>
</template>

<script>

import Navbar from "@/Components/Navbar/Navbar.vue";
import Filter from "@/Components/Filter/Filter.vue";
import Create from "@/Pages/Home/Create.vue";
import ProfileCard from "@/Components/User/ProfileCard.vue";
import Content from "@/Layouts/Content.vue";

export default {
    name: "User",
    components: {ProfileCard, Navbar,Filter,Create,Content},
    data() {
      return {
          sort: "new"
      }
    },
    props: {
        user: Object[0],
        posts: [],
    },
    created() {
        document.title = this.user[0].name;
    }
}
</script>

<style scoped>

</style>
