import axios from 'axios';

import service from '@/services/auth';

const tokenKey = 'token';
const expiredKey = 'expired';


const state = {
  token: localStorage.getItem(tokenKey) || '',
  expired: localStorage.getItem(expiredKey) || 0,
  status: '',
  hasLoadedOnce: false,
};
const getters = {
  isAuthenticated: state => (!!state.token) && state.expired >= Date.now() /
    1000,
  expired: state => state.expired,
  authStatus: state => state.status,
};

const actions = {
  login({commit, dispatch}, payload) {
    commit('INIT');
    return new Promise((resolve, reject) => {
      service.login(payload.user.email, payload.user.password).
        then(response => {
          if (response.data.token) {
            commit('AUTHENTICATED', response);
            resolve(response);
          } else {
            reject({message: 'Incorrect Email or Password'});
          }
        }).
        catch(error => {
          commit('UNAUTHORIZED', error);
          localStorage.removeItem(tokenKey);
          localStorage.removeItem(expiredKey);
          reject(error);
        });
    });
  },
  logout({commit, dispatch}) {
    return new Promise(resolve => {
      commit('LOGOUT');
      localStorage.removeItem(tokenKey);
      resolve();
    });
  },
};

const mutations = {
  INIT: state => {
    state.status = 'loading';
  },
  AUTHENTICATED: (state, response) => {
    state.status = 'success';
    state.token = response.data.token;
    state.expired = response.data.expired;

    localStorage.setItem(tokenKey, response.data.token);
    localStorage.setItem(expiredKey, response.data.expired);
    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

    state.hasLoadedOnce = true;
  },
  UNAUTHORIZED: state => {
    state.status = 'error';
    state.hasLoadedOnce = true;
  },
  LOGOUT: state => {
    state.token = '';
    state.activeUser = {};
  },
};

const auth = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};

export default auth;
