<template>
<button class="p-2 bg-[#2D2D2D] text-center text-white rounded">
<slot class="inline-block"></slot><AngleDownIcon class="ml-3 inline-block"/>
</button>
</template>
<script>

import AngleDownIcon from "@/Components/Icons/AngleDownIcon.vue";
export default {
    name: "Button",
    components: {AngleDownIcon},
    // props: {
    //     label : String,
    //     disabled : Boolean,
    // },
    // methods : {
    //     callback: function(e) {
    //         this.$emit('click', e);
    // }
};
</script>

<style scoped>

</style>
