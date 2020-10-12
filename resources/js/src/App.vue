<template>
  <div id="tasks-spa">
    <notifications group="default"/>
    <notifications group="top-right"
                   :duration="6000"
                   :width="500"
                   position="top right"
    />
    <notifications group="top-center"
                   :duration="6000"
                   :width="500"
                   position="top center"
    />
    <div>
      <router-view/>
    </div>
  </div>
</template>
<script>

export default {
  name: 'app',
  async created() {
    if (this.$store.getters['auth/isAuthenticated']) {
      await this.$store.dispatch('profile/me').
        catch((error) => {
            if (401 === error.response.status
              && 'Unauthenticated.' === error.response.data.message) {}
            this.$store.dispatch('auth/logout');
          },
        );
    }
  },
};
</script>

