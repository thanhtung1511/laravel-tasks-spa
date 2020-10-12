import qs from 'qs';
import axios from 'axios';

const url = '/api/users';

function init() {
  if (!axios.defaults.headers.common['Authorization']) {
    const token = localStorage.getItem('token');
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  }
}

function list(params) {
  const options = {
    params: params,
    paramsSerializer: function(params) {
      return qs.stringify(params, {encode: false});
    },
  };

  init();

  return axios.get(`${url}/`, options);
}

export default {
  list,
};