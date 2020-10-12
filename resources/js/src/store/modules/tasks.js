import service from '@/services/tasks';

const state = {
  list: {},
  task: {},
};

const mutations = {
  SET_LIST: (state, list) => {
    state.list = list;
  },
  SET_RESOURCE: (state, task) => {
    state.task = task;
  },
  REMOVE_RESOURCE_FROM_LIST: (state) => {
    const i = state.list.map(item => item.id).indexOf(state.task.id);
    state.list.splice(i, 1);
  },
};

const actions = {
  list({commit, dispatch}, params) {
    return new Promise((resolve, reject) => {
      return service.list(params).
        then(response => {
          commit('SET_LIST', response.data);
          resolve(response);
        }).
        catch(error => reject(error.response));
    });
  },

  get({commit, dispatch}, params) {
    return service.get(params).
      then((task) => {
        commit('SET_RESOURCE', task);
      });
  },

  add({commit, dispatch}, task) {
    console.log(task);
    commit('SET_RESOURCE', task);
    return new Promise((resolve, reject) => {
      return service.add(task).
        then(response => {
          commit('SET_RESOURCE', response.data);
          resolve(response);
        }).
        catch(error => reject(error.response));
    });
  },

  update({commit, dispatch}, task) {
    commit('SET_RESOURCE', task);
    return new Promise((resolve, reject) => {
      return service.update(task).
        then(response => {
          commit('SET_RESOURCE', response.data);
          resolve(response);
        }).
        catch(error => reject(error.response));
    });
  },

  destroy({commit, dispatch}, task) {
    commit('SET_RESOURCE', task);
    return new Promise((resolve, reject) => {
      return service.destroy(task).
        then(response => {
          commit('REMOVE_RESOURCE_FROM_LIST');
          resolve(response);
        }).
        catch(error => reject(error.response));
    });
  },

  complete({commit, dispatch}, task) {
    commit('SET_RESOURCE', task);
    return new Promise((resolve, reject) => {
      return service.complete(task).
        then(response => {
          commit('REMOVE_RESOURCE_FROM_LIST');
          resolve(response);
        }).
        catch(error => reject(error.response));
    });
  },

};

const getters = {
  list: state => state.list,
  task: state => state.task,
};

const tasks = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};

export default tasks;