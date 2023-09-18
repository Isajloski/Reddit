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
                <div class=" text-gray-500 text-sm text-center">{{ this.childKarma }}</div>
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
                    <img :src="image"
                         class="object-cover w-10 h-10 rounded-xl border-2 border-pink-700  shadow-emerald-400" alt="">
                    <h3 class="font-bold text-white">
                        {{ userName }}
                        <br>
                        <span class="text-xs text-gray-400 font-normal">{{ date }}</span>
                    </h3>
                </div>
                <p class="text-gray-400 mt-2" v-if="!editMode">
                    {{ childBody }}
                </p>
                <textarea v-if="this.editMode"
                          class="bg-neutral-800 rounded border border-gray-400 text-gray-50
            leading-normal resize-none w-full h-20 py-2 px-3 font-medium
            placeholder-gray-400 focus:outline-none focus:bg-neutral-800" v-model="this.editBody"
                          name="body" placeholder="Comment" required>{{this.body}}</textarea>
                <div class="flex gap-3 ">
                    <button class="text-right text-pink-700"
                            @click="toggleWriteReply()">Reply
                    </button>


                    <button v-if="owner === user_id" class="text-right text-pink-700"
                            @click="toggleEditMode">Edit
                    </button>
                    <button v-if="owner === user_id" class="text-right text-pink-700"
                            @click="handleDelete()">Delete
                    </button>

                    <button class="text-right text-pink-700"
                            @click="fetchReplies()"> Replies {{ repliesNumber }}
                    </button>
                </div>

                <WriteComment v-if="writeReply" @commentEmitter="handleReply"
                              :parent-id="this.id"/>
                <div class="w-full flex justify-end px-3 my-3">
                    <input v-if="this.editMode" type="button" @click="editComment()"
                           class="bg-blend-darken px-2.5 py-1.5 rounded-md text-white text-sm bg-pink-700 text-lg"
                           value='Edit Comment'>
                </div>
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
                     :owner="owner"
                     :user_id="user_id"
                     @commentDeleteEmitter="handleDeleteReply(reply.id)"
                     @commentEditEmitter="handleEditReply($event)"
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
    emits: ['commentDeleteEmitter', 'commentEditEmitter'],
    data() {
        return {
            writeReply: false,
            replies: [],
            voteUpState: false,
            voteDownState: false,
            childKarma: this.karma,
            editMode: false,
            editBody: '',
            childBody: this.body,
            image: 'https://imgv3.fotor.com/images/blog-cover-image/part-blurry-image.jpg',
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
    props: {
        id: Number,
        userName: String,
        picture: Image,
        body: String,
        post_id: Number,
        date: String,
        parent_comment_id: Number,
        karma: Number,
        repliesNumber: Number,
        vote: Boolean,
        owner: Number,
        user_id: Number
    },
    watch: {
        id(newVal){
            this.fetchUserImage();
        }
    },
    methods: {
        toggleWriteReply() {
            this.writeReply = !this.writeReply;
        },
        toggleEditMode() {
            this.editMode = !this.editMode;
            if (this.editMode) {
                this.editBody = this.body;
            }
        },
        handleReply(data) {
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
                }
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        async handleDelete() {
            try {
                const response = await ApiUtilis.deleteComment(this.id);
                this.emitDeleteToParent(this.id);
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        async handleDeleteReply(id) {
            try {
                const response = await ApiUtilis.deleteComment(id);
                const index = this.replies.findIndex(reply => reply.id === id);
                if (index !== -1) {
                    this.replies.splice(index, 1);
                }
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        handleEditReply(replyDto) {
            const index = this.replies.findIndex(reply => reply.id === replyDto.id);
            this.replies[index].body = replyDto.body;
        },
        emitDeleteToParent($id) {
            this.$emit('commentDeleteEmitter', $id);
        },
        emitEditToParent(commentUpdateDto) {
            this.$emit('commentEditEmitter', commentUpdateDto);
        },
        async editComment() {

            const commentUpdateDto = {
                id: this.id,
                body: this.editBody
            }

            try {
                const response = await ApiUtilis.editComment(this.id, commentUpdateDto);
                this.childBody = response.data.body;
                this.editMode = false;
                this.emitEditToParent(commentUpdateDto);
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        async fetchReplies() {
            try {
                const response = await ApiUtilis.getCommentReplies(this.id);
                this.replies = response.data;
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        fetchUserImage() {
            if (this.id) {
                ApiUtilis.getCommentUserImage(this.id)
                    .then((response) => {
                        this.image = response.data;
                    })
                    .catch((error) => {
                        console.error('Error fetching community image:', error);
                    });
            }
        }
    },
    mounted() {
        this.fetchUserImage();
    }
}
</script>

<style scoped>

</style>
