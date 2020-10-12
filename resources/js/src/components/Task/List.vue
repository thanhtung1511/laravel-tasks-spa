<template>
  <div class="md-layout">
    <div class="md-layout-item md-size-100">
      <md-card>
        <md-card-header class="md-card-header-icon md-card-header-green">
          <div class="card-icon">
            <md-icon>assignment</md-icon>
          </div>
          <h4 class="title">Tasks List</h4>
        </md-card-header>
        <md-card-content>
          <div class="text-right">
            <md-button class="md-primary" v-if="canAssign" href="/tasks/create">New Task</md-button>
          </div>
          <div v-if="tasks">
            <md-table
              :value="tasks"
              class="paginated-table table-striped table-hover"
            >
              <md-table-toolbar/>
              <md-table-row slot="md-table-row" slot-scope="{ item }">
                <md-table-cell md-label="Name">{{ item.name }}</md-table-cell>
                <md-table-cell md-label="Assigner">{{ item.assigner.name }}</md-table-cell>
                <md-table-cell md-label="Status">{{ item.status_label }}</md-table-cell>
                <md-table-cell md-label="Assigned At">{{ item.assigned_at }}</md-table-cell>
                <md-table-cell md-label="Actions">
                  <md-button class="md-icon-button md-raised md-dense md-info"
                             style="margin: .2rem;" @click="completeTask(item)">
                    <md-icon>check</md-icon>
                  </md-button>
                </md-table-cell>
              </md-table-row>
            </md-table>

            <div class="footer-table md-table">
              <table>
                <tfoot>
                <tr>
                  <th v-for="item in footerTable" :key="item.name" class="md-table-head">
                    <div class="md-table-head-container md-ripple md-disabled">
                      <div class="md-table-head-label">
                        {{ item }}
                      </div>
                    </div>
                  </th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>

        </md-card-content>
      </md-card>
    </div>
  </div>
</template>

<script>

import {mapState} from 'vuex';

export default {

  data: () => ({
    tasks: [],
    footerTable: ['Name', 'Assigner', 'Status', 'Assigned At', 'Actions'],
  }),

  computed: {
    ...mapState({
      canAssign: state => state.profile.permissions.map(permission => permission.name).indexOf('create-task') >= 0 &&
        state.profile.permissions.map(permission => permission.name).indexOf('assign-task') >= 0,
    }),
  },

  async created() {
    await this.$store.dispatch('tasks/list').
      then(() => {this.tasks = this.$store.getters['tasks/list'];});
  },

  methods: {
    hasPermission(list, permission) {
      return list.map(permission => permission.name).indexOf(permission) >= 0;
    },

    completeTask(task) {
      this.$store.dispatch('tasks/complete', task).
        then(response => {
          this.tasks = this.$store.getters['tasks/list'];
          this.$notify({
            group: 'top-center',
            title: 'Success',
            text: 'Task has been completed',
            type: 'success',
          });
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