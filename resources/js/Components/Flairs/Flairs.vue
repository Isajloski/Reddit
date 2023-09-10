<template>
    <div class="py-2 md:py-5 bg-[#2D2D2D] rounded-xl">
        <div class="flex justify-start px-3" v-for="flair in flairs">
            <div class="p-2 text-white font-light text-sm rounded bg-[#505050] m-1 cursor-pointer" :class="{'bg-[#CC0974]' : selectedFlair === flair.name}"
                 @click="filter(flair)">{{ flair.name }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Flairs",
    emits: ['selectedFlairEmitter'],
    data() {
        return {
            selectedFlair: ''
        }
    },
    props: {
        flairs: Array
    },
    methods: {
        filter(flair){
            if(this.selectedFlair!==''){
                this.selectedFlair = '';
                this.$emit('selectedFlairEmitter', '');
            }
            else{
                this.selectedFlair = flair.name;
                this.$emit('selectedFlairEmitter', flair.id);
            }
        }
    }
}
</script>

<style scoped>

</style>
