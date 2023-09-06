<template>
    <div>
        <div class="flex w-full border border-[#505050] rounded-md p-3">

            <div class="flex flex-col gap-1 pr-3 py-3">
                <div>
                    <VoteUpIcon
                        class="w-4 h-4 cursor-pointer"
                        :vote-up="this.voteUpState"
                        @click="voteUp(this.id)"
                    />
                </div>
                <div class=" text-gray-500 text-sm text-center">{{this.childKarma}}</div>
                <div>
                    <VoteDownIcon
                        class="w-4 h-4 cursor-pointer"
                        :vote-down="this.voteDownState"
                        @click="voteDown(this.id)"
                    />
                </div>
            </div>

            <div class="p-3 w-full">
                <div class="flex gap-3">
                    <img src="https://avatars.githubusercontent.com/u/22263436?v=4"
                         class="object-cover w-10 h-10 rounded-xl border-2 border-pink-700  shadow-emerald-400" alt="">
                    <h3 class="font-bold text-white">
                        {{ userName }}
                        <br>
                        <span class="text-xs text-gray-400 font-normal">{{ date }}</span>
                    </h3>
                </div>
                <p class="text-gray-400 mt-2">
                    {{ body }}
                </p>
                <div class="flex gap-3 ">
                    <button class="text-right text-pink-700"
                            @click="toggleWriteReply()">Reply</button>
                    <button class="text-right text-pink-700"
                            @click="">Edit</button>
                    <button class="text-right text-pink-700"
                            @click="handleDelete()">Delete</button>
                    <button class="text-right text-pink-700"
                            @click="fetchReplies()"> Replies {{repliesNumber}}</button>
                </div>
                <WriteComment v-if="writeReply" @commentEmitter="handleReply"
                              :parent-id="this.id" />
            </div>
        </div>
        <div v-for="reply in replies" :key="reply.id">
            <div class="text-[#505050] font-bold pl-14">|</div>
            <Comment class="ml-5"
                     :body="reply.body"
                     :id="reply.id"
                     :date="reply.date"
                     :karma="reply.karma"
                     :parent_comment_id="this.id"
                     :replies-number="reply.replies"
                     :vote="reply.vote"
                     :user-name="reply.user?.userName"
                     @commentDeleteEmitter="handleDelete"
            />
        </div>
    </div>
</template>

<script>
import VoteUpIcon from "@/Components/Icons/VoteUpIcon.vue";
import VoteDownIcon from "@/Components/Icons/VoteDownIcon.vue";
import WriteComment from "@/Components/Comment/WriteComment.vue";
import ApiUtilis from "@/Helpers/ApiUtilis";
export default {
    name: "Comment.vue",
    components: {WriteComment, VoteDownIcon, VoteUpIcon},
    emits: ['commentDeleteEmitter'],
    data() {
        return {
            writeReply: false,
            replies: [],
            voteUpState: false,
            voteDownState: false,
            childKarma: this.karma,
        }
    },
    created() {
        if (this.vote == null) {
            this.voteUpState = false;
            this.voteDownState = false;
        }
        if (this.vote === true) {
            this.voteUpState = true;
            this.voteDownState = false;
        }
        if (this.vote === false) {
            this.voteDownState = true;
            this.voteUpState = false;
        }
    },
    props : {
        id: Number,
        userName : String,
        picture : Image,
        body : String,
        post_id : Number,
        date : String,
        parent_comment_id: Number,
        karma : Number,
        repliesNumber: Number,
        vote: Boolean
    },
    methods: {
        toggleWriteReply(){
            this.writeReply = !this.writeReply;
        },
        handleReply(data){
            this.replies.push(data[0]);
        },
        async voteUp(commentId) {
            this.voteUpState = !this.voteUpState;
            this.voteDownState = false;

            const dto = {
                id: commentId,
                vote: this.voteUpState ? 1 : 0
            }

            try {
                if (dto.vote) {
                    const response = await ApiUtilis.voteComment(dto);
                    this.childKarma = response.data;
                } else {
                    const response = await ApiUtilis.deleteVoteComment(dto);
                    this.childKarma = response.data;
                }
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        async voteDown(commentId) {
            this.voteDownState = !this.voteDownState;
            this.voteUpState = false;

            const dto = {
                id: commentId,
                vote: this.voteDownState ? 0 : 1
            }

            try {
                if (dto.vote) {
                    const response = await ApiUtilis.deleteVoteComment(dto);
                    this.childKarma = response.data;
                } else {
                    const response = await ApiUtilis.voteComment(dto);
                    this.childKarma = response.data;
                    console.log(response)
                }
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        async handleDelete(){
            try {
                const response = await ApiUtilis.deleteComment(this.id);
                this.emitToParent(this.id);
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        emitToParent($id) {
            this.$emit('commentDeleteEmitter', $id);
        },
        async fetchReplies(){
            try {
                const response = await ApiUtilis.getCommentReplies(this.id);
                this.replies = response.data;
                console.log(this.replies)
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        }
    }
}
</script>

<style scoped>

</style>
