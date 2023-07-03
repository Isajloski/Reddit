import axios from 'axios';

const Repository = {
    fetchCommunity(id) {
        return axios.get(`/community/${id}`);
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
        console.log(id);
        console.log(editForm);
        return axios.post(`/communities/${id}/edit`, editForm);
    },
};

export default Repository;
