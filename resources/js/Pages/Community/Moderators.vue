<template>
    <div class="inline-block bg-[#2D2D2D] px-5 lg:px-10 py-5 rounded-2xl">
        <div class="text-lg text-white pb-3">Moderators</div>
        <div class="text-xs lg:text-sm text-white line-clamp-6 lg:line-clamp-none">
            <div v-for="moderator in moderators">
                <div class="py-2">
                    <div >
                        -  <a :href="`/user/${moderator.user.name}`"> {{ moderator.user.name}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ApiUtilis from "@/Helpers/ApiUtilis";

export default {
    name: "Moderators",
    data() {
        return {
            moderators: [],
        }
    },
    props : {
        community: Object,
    },
    methods: {
        async fetchModerator(){
            const response =   await  ApiUtilis.fetchModerators(this.community.id);
            this.moderators = response.data;
        },
    },
    created() {
        setInterval(() => {
            this.fetchModerator();
        }, 1000); // 3000 milliseconds (3 seconds)
    }

}
</script>

<style scoped>

</style>
