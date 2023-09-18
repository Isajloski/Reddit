
<template>
    <div class="bg-cover bg-center object-cover aspect-auto rounded-lg h-40" :style="`background-image: url(${imageUrl});`"></div>
</template>


<script>

import ApiUtils from "@/Helpers/ApiUtilis";

export default {
    props: {
        image: Number
    },
    name: 'ProfileBacgkroundPicture',
    data() {
        return {
            imageUrl: 'https://imgv3.fotor.com/images/blog-cover-image/part-blurry-image.jpg',
        };
    },
    methods: {
        fetchImage(id) {
            ApiUtils.fetchImage(id)
                .then((imagePath) => {
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
