<template>
  <ul class="nav nav-mobile-menu">
    <li>
      <drop-down>
        <md-button
          slot="title"
          class="md-button md-just-icon md-simple"
          data-toggle="dropdown"
        >
          <md-icon>person</md-icon>
          <p class="hidden-lg hidden-md">Profile</p>
        </md-button>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="javascript:void(0)" v-if="isAuthenticated" @click="logout">Logout</a></li>
        </ul>
      </drop-down>
    </li>
    <li>
      <a href="#" data-toggle="dropdown" class="dropdown-toggle"
      ><i class="material-icons">person</i>
        <p>Profile</p></a
      >
    </li>
  </ul>
</template>
<script>
import {mapState} from 'vuex';

export default {
  data() {
    return {
    };
  },
  computed: {
    ...mapState({
      authLoading: state => state.auth.status === 'loading',
      name: state => `${state.user.profile.title} ${state.user.profile.name}`,
    }),
  },
  methods: {
    logout: function() {
      this.$store.dispatch('auth/logout').then(() => this.$router.push('/login'));
    },
  }
};
</script>
