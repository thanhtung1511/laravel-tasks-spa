<template>
  <div class="user">
    <div class="user-info">
      <a
        data-toggle="collapse"
        :aria-expanded="!isClosed"
        @click.stop="toggleMenu"
        @click.capture="clicked"
      >
        <span>
          {{ title }}
          <b class="caret"></b>
        </span>
      </a>

      <collapse-transition>
        <div v-show="!isClosed">
          <ul class="nav">
            <slot>
              <li>
                <a @click="logout">
                  <span class="sidebar-normal">Logout</span>
                </a>
              </li>
            </slot>
          </ul>
        </div>
      </collapse-transition>
    </div>
  </div>
</template>
<script>

export default {
  props: {
    title: {
      type: String,
      default: 'Profile',
    },
  },
  data() {
    return {
      isClosed: true,
    };
  },

  methods: {
    clicked: function(e) {
      e.preventDefault();
    },
    toggleMenu: function() {
      this.isClosed = !this.isClosed;
    },
    logout: function() {
      this.$store.dispatch('auth/logout').then(() => this.$router.push('/login'));
    },
  },
};
</script>
<style>
.collapsed {
  transition: opacity 1s;
}
</style>
