<template>
  <footer class="footer">
    <div class="container">
      <div class="copyright text-center">&copy; {{ year }}, build for testing by <b>Toby Phi</b> on <a
        href="https://github.com/thanhtung1511/laravel-tasks-spa" target="_blank">GitHub</a>.
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  props: {
    backgroundColor: String,
    type: String,
  },
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
};
</script>
<style></style>
