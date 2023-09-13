<template>
    <img :src="imageUrl" alt="Profile Picture" class="w-12 h-12   object-cover rounded-lg object-cover border-2 border-white mx-5 md:mx-0">
</template>


<script>

import ApiUtils from "@/Helpers/ApiUtilis";

export default {
    props: {
        image: Number
    },
    name: 'ProfilePicture',
    data() {
        return {
            imageUrl: 'https://imgv3.fotor.com/images/blog-cover-image/part-blurry-image.jpg',
        };
    },
    methods: {
        fetchImage(id) {
            ApiUtils.fetchImage(id)
                .then((imagePath) => {
                    console.log(imagePath);
                    this.imageUrl = imagePath;
                })
                .catch((error) => {
                    console.error('Error fetching image:', error);
                });
        },
    },
    mounted() {
        this.fetchImage(this.image);
    },
};

</script>

<style scoped>

</style>
