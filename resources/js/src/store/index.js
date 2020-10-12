import Vue from "vue";
import Vuex from "vuex";
import auth from "./modules/auth";
import profile from "./modules/profile";
import users from "./modules/users";
import tasks from "./modules/tasks";
Vue.use(Vuex);

const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
  modules: {
    auth,
    profile,
    users,
    tasks,
  },
  strict: debug
});
