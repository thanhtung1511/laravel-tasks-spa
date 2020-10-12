import Vue from 'vue';
import Router from 'vue-router';
import {Login, Dashboard} from '@/layout';
import store from '@/store';
import TaskForm from '@/components/Task/Form';
import TaskList from '@/components/Task/List';

Vue.use(Router);

const ifNotAuthenticated = (to, from, next) => {
  if (!store.getters['auth/isAuthenticated']) {
    next();
    return;
  }
  next('/tasks');
};

const ifAuthenticated = (to, from, next) => {
  if (store.getters['auth/isAuthenticated']) {
    next();
    return;
  }
  next('/login');
};

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/tasks',
      name: 'task-list',
      component: Dashboard,
      children: [
        {
          path: '/',
          name: 'Tasks Management',
          component: TaskList,
        },
      ],
      beforeEnter: ifAuthenticated,
    },
    {
      path: '/tasks/create',
      name: 'task-create',
      component: Dashboard,
      children: [
        {
          path: '/',
          name: 'Tasks Management',
          component: TaskForm,
        },
      ],
      beforeEnter: ifAuthenticated,
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      beforeEnter: ifNotAuthenticated,
    },
    { path: '*', redirect: '/tasks' }
  ],
});
