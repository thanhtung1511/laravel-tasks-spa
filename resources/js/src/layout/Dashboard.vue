<template>
  <div class="wrapper">
    <notifications></notifications>
    <side-bar :active-color="sidebarBackground" :background-image="sidebarBackgroundImage"
              :data-background-color="sidebarBackgroundColor" :title="greeter">
      <user-menu :title="profile.name"/>
      <mobile-menu/>
      <template slot="links">
        <sidebar-item :link="{ name: 'Tasks', icon: 'assignment' }">
          <sidebar-item
            :link="{ name: 'List', path: '/tasks' }"
          />
          <sidebar-item
            :link="{ name: 'New Task', path: '/tasks/create' }"
          />
        </sidebar-item>

      </template>
    </side-bar>

    <div class="main-panel">
      <top-navbar></top-navbar>
      <div :class="{ content: !$route.meta.hideContent }">
        <zoom-center-transition :duration="200" mode="out-in">
          <!-- your content here -->
          <router-view/>
        </zoom-center-transition>
      </div>
      <content-footer/>
    </div>
  </div>
</template>
<script>

import TopNavbar from './TopNavbar.vue';
import ContentFooter from './ContentFooter.vue';
import MobileMenu from './Extra/MobileMenu.vue';
import UserMenu from './Extra/UserMenu.vue';
import {mapState} from 'vuex';

export default {
  components: {
    TopNavbar,
    ContentFooter,
    MobileMenu,
    UserMenu,
  },
  data: () => ({
    sidebarBackgroundColor: 'black',
    sidebarBackground: 'green',
    sidebarBackgroundImage: require("@/assets/img/sidebar-2.jpg"),
    sidebarMini: true,
    sidebarImg: true,
    image: '',
  }),
  methods: {
    getProfile() {
      this.profile = this.$store.getters['profile/me'];
      this.greeter = `Hello ${this.profile.name}`;
    },
    toggleSidebar() {
      if (this.$sidebar.showSidebar) {
        this.$sidebar.displaySidebar(false);
      }
    },
    minimizeSidebar() {
      if (this.$sidebar) {
        this.$sidebar.toggleMinimize();
      }
    },

  },
  computed: {
    ...mapState({
      profile: state => `${state.profile.me}`,
      greeter: state => `Hello ${state.profile.me.name}`,
    }),
  },
  watch: {
    sidebarMini() {
      this.minimizeSidebar();
    },
  },
};
</script>
<style lang="scss">
$scaleSize: 0.95;
@keyframes zoomIn95 {
  from {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
  to {
    opacity: 1;
  }
}

.main-panel .zoomIn {
  animation-name: zoomIn95;
}

@keyframes zoomOut95 {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
}

.main-panel .zoomOut {
  animation-name: zoomOut95;
}
</style>

