<template>
    <div class="w-full mx-auto z-0">
        <div class="pt-2 px-5 md:px-7">
            <div class="grid grid-cols-2 relative">
                <a :href="'/community/'+ communityId">
                    <div class="inline-block relative">
                        <TestIcon class="z-10 inline-block w-4 h-4"/>
                        <div class="ml-2 text-white inline-block text-base md:text-lg">{{ communityName }}</div>
                        <span class="text-xs ml-0.5 bottom-0 absolute text-[#898989] mb-1 font-light">/community</span>
                    </div>
                </a>
                <div class="inline-block text-right mr-20">
                    <span
                        class="text-xs bottom-0 text-[#898989] mb-1 font-light hidden md:inline-block">Posted by</span>
                    <span class="text-xs ml-1 bottom-0 absolute text-white mb-1.5">{{ byUser }}</span>
                </div>
            </div>
            <div class="py-1">
                <div class="px-5 rounded-2xl bg-gray-500 text-sm inline-block">
                    {{flair && flair.name}}
                </div>
            </div>
            <div class="">
                <img class="object-cover w-full h-60 object-center rounded"
                     src="https://img.freepik.com/free-photo/beautiful-aerial-shot-fronalpstock-mountains-switzerland-beautiful-pink-blue-sky_181624-9315.jpg?w=1380&t=st=1685478210~exp=1685478810~hmac=1e718a3ae50f16e79ae05aa4a78ce930705b92631f89e1e35cc55ebf9c2b1e63"/>
            </div>
            <div class="px-2 pt-3">
                <div class="w-full grid grid-cols-2 relative">
                    <div>
                        <div class="inline-block mr-2">
                            <VoteUpIcon :voteUp="this.voteUpState"
                                        class="cursor-pointer w-4 h-4 inline-block mx-1"
                                        @click="voteUp(id)" />
                            <div class="inline-block">
                                <span class="text-white text-sm">{{ childKarma }}</span>
                            </div>
                        </div>
                        <div class="inline-block">
                            <VoteDownIcon
                                :voteDown="this.voteDownState"
                                class="cursor-pointer w-4 h-4 inline-block mx-1"
                                @click="voteDown(id)"/>
                        </div>
                        <div class="inline-block">
                            <CommentIcon class="w-4 h-4 inline-block ml-3 cursor-pointer"
                                         @click="this.toggleComments()"/>
                            <span
                                class="mx-2 inline-block text-[#898989] text-xs font-light hidden md:inline-block">{{ commentsNumber }} Comments</span>
                        </div>
                        <div class="inline-block">
                            <ShareIcon class="w-4 h-4 inline-block ml-3"/>
                            <span class="mx-2 inline-block text-[#898989] text-xs font-light hidden md:inline-block">Share</span>
                        </div>
                    </div>
                    <div class="right-0 absolute">
                        <span class="text-xs text-[#898989]">{{ date }}</span>
                    </div>
                </div>
                <div class="py-2">
                    <p class="text-[#898989] pt-2 line-clamp-4 w-full text-sm md:text-base">{{
                            description
                        }}</p>
                    <p class="pt-1 text-white"> Expand post</p>
                </div>
            </div>
            <hr class="text-[#505050] border-[#505050] border-2"/>
        </div>
    </div>
    <div v-if="openCommentSection" class=" border-[#505050] border-2 rounded-lg p-1 md:p-3 m-10">
        <h3 class=" p-1 text-gray-400">Discussion</h3>
        <div class="flex flex-col gap-5 m-3" v-for="comment in comments" :key="comment.id">
            <Comment :body="comment.body"
                     :id="comment.id"
                     :date="comment.date"
                     :karma="comment.karma"
                     :replies-number="comment.replies"
                     :post_id="comment.post_id"
                     :vote="comment.vote"
                     :user-name="comment.user?.userName"
                     @commentDeleteEmitter="handleDelete"
                     @commentEditEmitter="handleEdit"
            />
        </div>
        <WriteComment :postId="this.id" @commentEmitter="handleComment"/>
    </div>
</template>

<script>
import TestIcon from "@/Components/Icons/TestIcon.vue";
import ShareIcon from "@/Components/Icons/ShareIcon.vue";
import VoteUpIcon from "@/Components/Icons/VoteUpIcon.vue";
import Comment from "@/Components/Comment/Comment.vue";
import VoteDownIcon from "@/Components/Icons/VoteDownIcon.vue";
import CommentIcon from "@/Components/Icons/CommentIcon.vue";
import ApiUtilis from "@/Helpers/ApiUtilis";
import WriteComment from "@/Components/Comment/WriteComment.vue";

export default {
    name: "Post",
    components: {WriteComment, CommentIcon, VoteDownIcon, VoteUpIcon, ShareIcon, TestIcon, Comment},
    data() {
        return {
            childKarma: this.karma,
            childVote: this.vote,
            voteUpState: false,
            voteDownState: false,
            openCommentSection: false,
            comments: []
        }
    },
    mounted() {
        ApiUtilis.getPostComments(this.id)
            .then((response) => {
                this.comments = response.data;
            })
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
        communityName: String,
        communityId: Number,
        byUser: String,
        karma: Number,
        title: String,
        image: String,
        description: String,
        date: String,
        vote: Boolean | null,
        commentsNumber: Number,
        flair: Object
    },
    methods: {
        async voteUp(postId) {
            this.voteUpState = !this.voteUpState;
            this.voteDownState = false;

            const dto = {
                postId: postId,
                vote: this.voteUpState ? 1 : 0
            }

            try {
                if (dto.vote) {
                    const response = await ApiUtilis.votePost(dto);
                    this.childKarma = response.data;
                } else {
                    const response = await ApiUtilis.deleteVotePost(dto);
                    this.childKarma = response.data;
                }
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        async voteDown(postId) {
            this.voteDownState = !this.voteDownState;
            this.voteUpState = false;

            const dto = {
                postId: postId,
                vote: this.voteDownState ? 0 : 1
            }

            try {
                if (dto.vote) {
                    const response = await ApiUtilis.deleteVotePost(dto);
                    this.childKarma = response.data;
                } else {
                    const response = await ApiUtilis.votePost(dto);
                    this.childKarma = response.data;
                }
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        },
        toggleComments(){
            this.openCommentSection = !this.openCommentSection;
        },
        handleComment(data) {
            this.comments.push(data[0])
        },
        handleDelete(id){
            const index = this.comments.findIndex(comment => comment.id === id);
            if (index !== -1) {
                this.comments.splice(index, 1);
            }
        },
        handleEdit(commentUpdateDto){
            const index = this.comments.findIndex(comment => comment.id === commentUpdateDto.id);
            this.comments[index].body = commentUpdateDto.body;
        }
    }
}
</script>

<style scoped>

</style>
