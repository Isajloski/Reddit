<script>
import {Head, Link} from '@inertiajs/vue3';
import Navbar from "@/Components/Navbar/Navbar.vue";
import Filter from "@/Components/Filter/Filter.vue";
import Create from "@/Pages/Home/Create.vue";
import Content from "@/Layouts/Content.vue";


export default {
    name: 'Welcome',
    components: {Head, Navbar, Link, Filter, Content, Create},
    data() {
        return {
            sort: 'new'
        }
    },
    methods : {
        emitSortType(sort){
            this.sort = sort;
        }
    }

}
</script>

<template>
    <Head><title>Welcome</title></Head>
    <Navbar/>
    <div id="left" class="absolute mt-32 md:mt-20 w-auto md:w-1/6 ml-5">
        <Filter class="rounded-xl" @sort="emitSortType($event)"/>
    </div>
    <div id="right" class="absolute mt-10 md:mt-20 w-auto md:w-1/6 md:right-0 mx-5">
        <Create class="rounded-xl"/>
    </div>
    <Content :type="'home'" :sort="this.sort"/>
</template>

