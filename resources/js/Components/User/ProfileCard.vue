<template>
    <div>
        <ProfileBacgkroundPicture :image="user.info.image_id"  />
        <div class="bg-[#2d2d2d] rounded-lg shadow-lg p-6">
            <div class="flex items-center">
<!--                <img :src="user" alt="Profile Picture" class="w-12 h-12  object-cover rounded-lg object-cover border-2 border-white mx-5 md:mx-0">-->
                <ProfilePicture :image="user.info.image_id"/>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold" style="color: #F20085">{{ user.name }}</h2>
                    <p class="text-gray-200">{{ user.karma.karma }} Karma</p>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-gray-200">{{ user.info.bio }}</p>
            </div>
            <br>
            <div class="flex justify-between mt-6">
                <div v-if="user.status.active">
                    <p class="text-sm font-semibold text-green-500">Online</p>
                </div>
                <div v-else>
                    <p class="text-sm font-semibold text-red-500">Offline</p>
                </div>
                <div>
                    </div>
                <div>
                 </div>
            </div>
        </div>
    </div>
</template>
<script>
// import ProfilePicture from "@/Components/User/ProfilePicture.vue";
import ProfileBacgkroundPicture from "@/Components/User/ProfileBacgkroundPicture.vue";
import ProfilePicture from "@/Components/User/ProfilePicture.vue";
export default {
    components: {ProfilePicture, ProfileBacgkroundPicture},
    props: {
        user: Object,
    },
    data() {
        return {

        };
    }
};
</script>
