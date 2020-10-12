import axios from 'axios';

export default {
  me() {
    if (!axios.defaults.headers.common['Authorization']) {
      const token = localStorage.getItem('token');
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }

    return axios.get('/api/auth/me');
  },
};
