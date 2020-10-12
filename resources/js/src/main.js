import Vue from 'vue';
import Notifications from 'vue-notification';

import App from './App.vue';
import router from './router';
import store from './store';

import MaterialKit from './plugins/material-kit';


Vue.config.productionTip = false;

Vue.use(Notifications);
Vue.use(MaterialKit);


const NavbarStore = {
  showNavbar: false,
};

Vue.mixin({
  data() {
    return {
      NavbarStore,
    };
  },
});

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app');
