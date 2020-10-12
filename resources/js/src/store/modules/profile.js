import service from '@/services/profile';

const userKey = 'activeUser';

const state = {
  status: '',
  me: {},
  roles: [],
  permissions: [],
};

const getters = {
  me: state => state.me,
  roles: state => state.roles,
  permissions: state => state.permissions,
};

const mutations = {
  LOADING_RESOURCE: state => {
    state.status = 'loading';
  },
  RESOURCE_LOADED: state => {
    state.status = 'success';
  },
  SET_RESOURCE: (state, me) => {
    const user = JSON.parse(localStorage.getItem(userKey)) || state.me;
    for (const property of Object.keys(me)) {
      if (property === 'roles') {
        continue;
      }
      if (me[property] !== null) {
        user[property] = me[property];
      }
    }
    state.me = user;
    localStorage.setItem(userKey, JSON.stringify(user));
  },
  SET_ROLES_PERMISSIONS: (state, me) => {
    if (me.roles !== undefined) {
      for (let i in me.roles) {
        const role = {};
        for (const property of Object.keys(me.roles[i])) {
          if (property === 'permissions') {
            const permissions = me.roles[i][property];
            for (let t in permissions) {
              if (state.permissions.length &&
                state.permissions.map(item => item.id).
                  indexOf(permissions[t].id) >= 0) {
                continue;
              }
              state.permissions.push(permissions[t]);
              continue;
            }
          }
          if (me.roles[i][property] !== null) {
            role[property] = me.roles[i][property];
          }
        }
        state.roles.push(role);
      }
    }
  },
  UNSET_RESOURCE: state => {
    state.me = {};
    state.roles = [];
    state.permissions = [];
    localStorage.removeItem(userKey);
  },
  LOAD_FAILED: state => {
    state.status = 'error';
  },
};

const actions = {
  me({commit, dispatch}) {
    commit('LOADING_RESOURCE');
    return new Promise((resolve, reject) => {
      service.me().
        then(response => {
          if (response.data.user) {
            commit('SET_RESOURCE', response.data.user);
            commit('SET_ROLES_PERMISSIONS', response.data.user);
            commit('RESOURCE_LOADED');
            resolve(response);
          }
        }).
        catch(error => {
          commit('LOAD_FAILED');
          commit('UNSET_RESOURCE');
          reject(error);
        });
    });
  },
};

const profile = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};

export default profile;

