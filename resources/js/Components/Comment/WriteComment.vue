<template>
    <div class="w-full px-3 mb-2 mt-6">
        <textarea
            class="bg-neutral-800 rounded border border-gray-400 text-gray-50
            leading-normal resize-none w-full h-20 py-2 px-3 font-medium
            placeholder-gray-400 focus:outline-none focus:bg-neutral-800"

            name="body"  v-model="body" placeholder="Comment" required></textarea>
    </div>

    <div class="w-full flex justify-end px-3 my-3">
        <input type="button" @click="writeComment()"
               class="bg-blend-darken px-2.5 py-1.5 rounded-md text-white text-sm bg-pink-700 text-lg"
               value='Post Comment'>
    </div>
</template>

<script>
import ApiUtilis from "@/Helpers/ApiUtilis";

export default {
    name: "WriteComment",
    emits: ['commentEmitter'],
    data() {
        return {
            body: '',
        }
    },
    props: {
        postId : null,
        parentId: null
    },
    methods: {
        async writeComment(){

            console.log(this.parentId)

            const commentCreationDto = {
                post_id: this.postId,
                parent_comment_id: this.parentId,
                body: this.body
            }

            try {
                const response = await ApiUtilis.writeComment(commentCreationDto);
                this.emitToParent(response.data);
                this.body = '';
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        emitToParent(commentDto) {
            this.$emit('commentEmitter', commentDto);
        },
    }
}
</script>

<style scoped>

</style>
