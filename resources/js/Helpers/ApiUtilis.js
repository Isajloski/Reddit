import axios from 'axios';
axios.defaults.baseURL = 'http://127.0.0.1:8000/';

const ApiUtilis = {
    fetchCommunity(id) {
        return axios.get(`/community/${id}/card`);
    },
    followCommunity(communityId) {
        return axios.post(`/follow/${communityId}`);
    },
    unfollowCommunity(communityId) {
        return axios.post(`/unfollow/${communityId}`);
    },
    fetchCommunityFlairs(communityId){
        return axios.get(`flair/community/${communityId}`);
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
        return axios.delete(`/post/${id}/delete`)
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
    editComment(id, commentUpdateDto){
        return axios.post(`/comment/${id}/edit`, commentUpdateDto);
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
    },
    editUserImage(formData){
        return axios.post(`/settings/image`, formData);
    },
    fetchUser(userName){
        return axios.get(`/user/${userName}`);
    },
    fetchUserPosts(userName, pageNumber, sortDto){
        return axios.post(`/user/${userName}/paginate?page=` + pageNumber, sortDto);
    },
    fetchUserFollowingCommunity(communityId){
        return axios.get(`/user/following/${communityId}`)
    },
    fetchImage(id) {
        return axios.get(`/image/${id}`)
            .then((response) => {
                return response.data.path;
            })
            .catch((error) => {
                console.error('Error fetching image:', error);
                throw error; // Rethrow the error for handling in the component
            });
    },
    createModerator(formData) {
       return  axios.post("/community/moderator/create", formData);
    },
    fetchModerators(id) {
        return axios.get(`/community/moderator/${id}`);
    },
    deleteModerator(id) {
        return axios.post(`/community/moderator/${id}/delete`);
    }
};

export default ApiUtilis;
