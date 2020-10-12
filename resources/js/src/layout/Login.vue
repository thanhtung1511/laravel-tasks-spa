<template>
    <div class="wrapper">
      <div class="section login-section page-header header-filter" :style="headerStyle">
        <div class="container">
          <div
            class="md-layout-item md-size-33 md-medium-size-50 md-small-size-70 md-xsmall-size-100"
          >
            <form @submit.prevent="login">
              <login-card header-color="blue">
                <h4 slot="title" class="title">Authentication</h4>
                <md-field
                  class="form-group md-invalid"
                  slot="inputs"
                  style="margin-bottom: 28px"
                >
                  <md-icon>email</md-icon>
                  <label>Email...</label>
                  <md-input v-model="email" type="email"/>
                </md-field>
                <md-field class="form-group md-invalid" slot="inputs">
                  <md-icon>lock_outline</md-icon>
                  <label>Password...</label>
                  <md-input v-model="password" type="password"/>
                </md-field>
                <md-button
                  slot="footer"
                  type="submit"
                  class="md-simple md-success md-lg"
                >
                  Login
                </md-button>
              </login-card>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import {LoginCard} from '@/components';

export default {
  components: {
    LoginCard,
  },
  bodyClass: 'login-page',
  data() {
    return {
      firstname: null,
      email: null,
      password: null,
    };
  },
  props: {
    header: {
      type: String,
      default: require('@/assets/img/city.jpg'),
    },
  },
  computed: {
    headerStyle() {
      return {
        backgroundImage: `url(${this.header})`,
      };
    },
  },
  methods: {
    async login() {
      const payload = {
        user: {
          email: this.email,
          password: this.password,
        },
      };
      await this.$store.dispatch('auth/login', payload).then(response => {
        this.$store.dispatch('profile/me');
        this.$router.push('/');
      }).catch(error => {
        this.$notify({
          group: 'top-center',
          title: 'Authentication Failed',
          text: 'Incorrect Email or Password',
          type: 'error',
        });
      });
    },
  },
};
</script>
