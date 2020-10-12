import service from '@/services/users';

const state = {
  list: {},
  user: {},
};

const mutations = {
  SET_LIST: (state, list) => {
    state.list = list;
  },
  SET_RESOURCE: (state, user) => {
    state.user = user;
  },
};

const actions = {
  list({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      return service.list(payload).
        then((response) => {
          commit('SET_LIST', response.data);
          resolve(response);
        }).
        catch(error => reject(error));
    });
  },
};

const getters = {
  list: state => state.list,
  task: state => state.user,
};

const tasks = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};

export default tasks;