import qs from 'qs';
import axios from 'axios';
import Jsona from 'jsona';


const url = '/api/tasks';
const headers = {
  'Accept': 'application/json',
  'Content-Type': 'application/json',
};
const jsona = new Jsona();

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

  console.log(params);

  init();

  return axios.get(`${url}/`, options);
}

function get(task) {
  const options = {
    headers: headers,
  };

  init();

  return axios.get(`${url}/${task.id}`, options);
}

function add(task) {
  const options = {
    headers: headers,
  };

  init();

  // const payload = jsona.serialize({
  //   stuff: task,
  //   includeNames: null
  // });

  return axios.post(`${url}/`, task, options)
}

function update(task) {

  const options = {
    headers: headers,
  };

  init();

  return axios.patch(`${url}/${task.id}`, {task}, options).
    then(response => {
      return jsona.deserialize(response.data);
    });
}

function destroy(task) {
  const options = {
    headers: headers,
  };

  init();

  return axios.delete(`${url}/${task.id}`, options);
}

function complete(task) {
  const options = {
    headers: headers,
  };

  init();

  return axios.put(`${url}/${task.id}/complete`, options);
}

export default {
  list,
  get,
  add,
  update,
  destroy,
  complete,
};