import axios from 'axios';

export default {
  login(email, pwd) {
    return axios.post('/api/auth/login', {
      email,
      password: pwd,
    });
  },
  logout() {
    return axios.post('/api/auth/logout', {});
  },
};
