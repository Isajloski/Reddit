import axios from 'axios';
axios.defaults.baseURL = 'http://127.0.0.1:8000/';

const ApiUtilis = {
    fetchCommunity(id) {
        return axios.get(`/community/${id}/card`);
    },
    fetchCommunityPosts(communityId, pageNumber, sortDto){
        return axios.post(`/community/${communityId}/paginate?page=` + pageNumber, sortDto);
    },
    fetchUserCommunities(){
        return axios.get('community/user/following');
    },
    createFlair(formData) {
        return axios.post('/flair/create', formData);
    },
    deleteFlair(id) {
        return axios.post(`/flair/${id}/delete`);
    },
    editFlair(id, formData) {
        return axios.post(`/flair/${id}/edit`, formData);
    },
    editCommunity(id, editForm) {
        return axios.post(`/community/${id}/edit`, editForm);
    },
    createPost(formData) {
        return axios.post(`/makePost`, formData);
    },
    editPost(id, editForm){
        return axios.post(`/posts/${id}/edit`, editForm);
    },
    fetchPost(id){
        return axios.get(`/posts/${id}`);
    },
    deletePost(id){
        return axios.delete(`/posts/${id}/delete`)
    },
    votePost(postVoteDto){
        return axios.post(`/post/${postVoteDto.postId}/vote`, postVoteDto);
    },
    deleteVotePost(postVoteDto){
        return axios.delete(`/post/${postVoteDto.postId}/vote/delete`);
    },
    writeComment(commentCreationDto){
        return axios.post(`/comment/create`, commentCreationDto);
    },
    getPostComments(postId){
        return axios.get(`post/${postId}/comments`);
    },
    deleteComment(commentId){
        return axios.delete(`comment/${commentId}/delete`);
    },
    voteComment(commentVoteDto){
        return axios.post(`/comment/${commentVoteDto.id}/vote`, commentVoteDto);
    },
    deleteVoteComment(commentVoteDto){
        return axios.delete(`/comment/${commentVoteDto.id}/vote/delete`);
    },
    getCommentReplies($commentId){
        return axios.get(`/comment/${$commentId}/replies`);
    },
    getPaginatedFollowingPosts(pageNumber, sortDto){
        return axios.post('/posts/following/paginate?page=' + pageNumber, sortDto);
    },
    getPaginatedTrendingPosts(pageNumber, sortDto){
        return axios.post('/posts/trending/paginate?page=' + pageNumber, sortDto);
    }
};

export default ApiUtilis;
