<template>
  <form @submit.prevent="createTask">
    <md-card>

      <md-card-header class="md-card-header-icon">
        <div class="card-icon">
          <md-icon>assignment</md-icon>
        </div>
        <h4 class="title">
          Assign New Task
        </h4>
      </md-card-header>

      <md-card-content>

        <div class="md-layout">
          <label class="md-layout-item md-size-15 md-form-label">
            Name
          </label>
          <div class="md-layout-item">
            <md-field class="md-invalid">
              <md-input v-model="task.name"/>
            </md-field>
          </div>
        </div>

        <div class="md-layout">
          <label class="md-layout-item md-size-15 md-form-label">
            Assignee
          </label>
          <div class="md-layout-item">
            <md-field class="md-invalid">
              <md-select v-model="task.assignee" name="assignee">
                <md-option
                  v-for="item in assignees"
                  :key="item.id"
                  :label="item.name"
                  :value="item.id"
                >
                  {{ item.name }}
                </md-option>
              </md-select>
            </md-field>
          </div>
        </div>

      </md-card-content>

      <md-card-actions v-if="canCreateTask">
        <md-button class="md-success" type="submit">Assign</md-button>
      </md-card-actions>

    </md-card>
  </form>
</template>

<script>

import {mapState} from 'vuex';

export default {
  data: () => ({
    task: {
      name: '',
      assignee: null,
    },
    assignees: [],
  }),

  computed: {
    ...mapState({
      canCreateTask: state => {
        return state.profile.permissions.map(permission => permission.name).indexOf('create-task') >= 0;
      },
    }),
  },

  async created() {
    await this.$store.dispatch('users/list').
      then(() => {this.assignees = this.$store.getters['users/list'];}).
      catch((error) => {/*this.$store.dispatch('auth/logout');*/});
  },

  methods: {
    async createTask() {
      await this.$store.dispatch('tasks/add', this.task).
        then(response => {
          this.$notify({
            group: 'top-center',
            title: 'Success',
            text: 'Task has been create & assigned',
            type: 'success',
          });
          this.$router.push('/tasks');
        }).
        catch(error => {
          this.$notify({
            group: 'top-center',
            title: 'Error',
            text: error.data.message,
            type: 'error',
          });
        });
    },
  },
};

</script>