import axios from 'axios';

const ApiUtilis = {
    fetchCommunity(id) {
        return axios.get(`/community/${id}`);
    },
    fetchUserCommunities(){
        return axios.get('communities/user/following');
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
        return axios.post(`/communities/${id}/edit`, editForm);
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
};

export default ApiUtilis;
