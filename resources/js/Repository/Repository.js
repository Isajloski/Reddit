import axios from 'axios';

const Repository = {
    fetchCommunity(id) {
        return axios.get(`/api/community/${id}`);
    },
    createFlair(formData) {
        return axios.post('/flair/create', formData);
    },
    deleteFlair(id) {
        return axios.post(`/flair/${id}/delete`);
    },
    editFlair(id, formData) {
        return axios.post(`/flair/${id}/edit`, formData);
    }
};

export default Repository;
