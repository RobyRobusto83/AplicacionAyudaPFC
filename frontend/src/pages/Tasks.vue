<template>
    <div>
        <div class="row">
            <div class="col-10">
                <div class="md-3">
                    <h5 class="card-title">Listado de tareas</h5>
                </div>
                <div class="md-3">
                  <b-button @click="create($event.target)">Nueva tarea</b-button>
                </div>
            </div>
        </div>
        <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <b-col lg="6" class="my-1">
        <b-form-group
          label="Sort"
          label-for="sort-by-select"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
          v-slot="{ ariaDescribedby }"
        >
          <b-input-group size="sm">
            <b-form-select
              id="sort-by-select"
              v-model="sortBy"
              :options="sortOptions"
              :aria-describedby="ariaDescribedby"
              class="w-75"
            >
              <template #first>
                <option value="">-- none --</option>
              </template>
            </b-form-select>

            <b-form-select
              v-model="sortDesc"
              :disabled="!sortBy"
              :aria-describedby="ariaDescribedby"
              size="sm"
              class="w-25"
            >
              <option :value="false">Asc</option>
              <option :value="true">Desc</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col lg="6" class="my-1">
        <b-form-group
          label="Initial sort"
          label-for="initial-sort-select"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-form-select
            id="initial-sort-select"
            v-model="sortDirection"
            :options="['asc', 'desc', 'last']"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>

      <b-col lg="6" class="my-1">
        <b-form-group
          label="Filter"
          label-for="filter-input"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              id="filter-input"
              v-model="filter"
              type="search"
              placeholder="Type to Search"
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col lg="6" class="my-1">
        <b-form-group
          v-model="sortDirection"
          label="Filter On"
          description="Leave all unchecked to filter on all data"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
          v-slot="{ ariaDescribedby }"
        >
          <b-form-checkbox-group
            v-model="filterOn"
            :aria-describedby="ariaDescribedby"
            class="mt-1"
          >
            <b-form-checkbox value="name">Nombre</b-form-checkbox>
            <b-form-checkbox value="priority">Prioridad</b-form-checkbox>
            <b-form-checkbox value="isCompleted">Completada</b-form-checkbox>
          </b-form-checkbox-group>
        </b-form-group>
      </b-col>

      <b-col sm="5" md="6" class="my-1">
        <b-form-group
          label="Per page"
          label-for="per-page-select"
          label-cols-sm="6"
          label-cols-md="4"
          label-cols-lg="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-form-select
            id="per-page-select"
            v-model="perPage"
            :options="pageOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>

       <b-col sm="7" md="2" class="my-1">
        <b>Tareas</b>: {{ totalRows }}
      </b-col>

      <b-col sm="7" md="3" class="my-1">
        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>
      <b-col sm="7" md="1" class="my-1">
        <b-button class="btn btn-success" @click="create($event.target)"><b-icon icon="plus"/></b-button>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filter-included-fields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      stacked="md"
      show-empty
      small
      @filtered="onFiltered"
    >
      <template v-slot:cell(name)="row">
        <b-card-text v-if="!row.item.isEdit">{{ row.item.name }}</b-card-text>
        <b-form-input v-model="row.item.name" v-if="row.item.isEdit"/>
      </template>
      <template v-slot:cell(description)="row">
        <b-card-text v-if="!row.item.isEdit">{{ row.item.description }}</b-card-text>
        <b-form-input v-model="row.item.description" v-if="row.item.isEdit"/>
      </template>
      <template v-slot:cell(priority)="row">
        <b-card-text v-if="!row.item.isEdit">{{ row.item.priority }}</b-card-text>
        <b-form-select v-model="row.item.priority" :options="options" v-if="row.item.isEdit"></b-form-select>
      </template>
      <template v-slot:cell(isCompleted)="row">
        <b-card-text v-if="!row.item.isEdit">{{ row.item.isCompleted ? "Sí": "No" }}</b-card-text>
        <b-form-checkbox v-model="row.item.isCompleted" v-if="row.item.isEdit" switch></b-form-checkbox>
      </template>
      <template #cell(actions)="row">
        <b-button size="sm"  @click="toggleEdit(row.index)" class="mr-1" variant="outline-primary">
            <b-icon icon="pen-fill" v-if="!row.item.isEdit"/><b-icon icon="file-check" v-if="row.item.isEdit" @click="updateTask(row.index, row.item)"/>
        </b-button>
        <b-button size="sm" @click="infoDeleteModal(row.item, row.index, $event.target)" class="mr-1" variant="outline-danger">
            <b-icon icon="trash"/>
        </b-button>
        <b-button size="sm" @click="llamadadeTiempo(row.item)" class="mr-1" variant="outline-success">
            <b-icon icon="clock" v-if="timer !== null"/>
        </b-button>
        <b-button size="sm" @click="row.toggleDetails" variant="outline-secondary">
          <b-icon v-if="row.detailsShowing" icon="eye-slash"/><b-icon v-else icon="eye"/>
        </b-button>
      </template>

      <template #row-details="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
          </ul>
        </b-card>
      </template>
    </b-table>

    <!-- Delete modal -->
    <b-modal :id="deleteModal.id" :title="deleteModal.title" @hide="resetDeleteModal" @ok="removeRow(deleteModal.index)">
        <p>Confirm that you are about to delete task: {{ deleteModal.content }}</p>
    </b-modal>    

    <!-- Create modal -->
    <CreateTaskModal :id="createModal.id" :title="createModal.title" v-bind:formData="newTask" @createdTask="createRow" @resetedNewTask="resetCreateModal"/>
    
    <!-- Edit modal -->
    <!-- <EditTaskModal :id="editModal.id" :title="editModal.title" v-bind:formUpdData="updateTask" /> -->
    <!-- @updatedTask="updateRow" @resetedUpdateTask="resetUpdateModal" -->
   <!--   -->
    
    <!-- <b-modal :id="timerModal.id" :title="timerModal.title" @hide="resetTimerModal" @ok="addTimer(timerModal.index)">
        <TimerClock />
    </b-modal>   -->
  </b-container>
    </div>
</template>
    
<script>  
// https://stackoverflow.com/questions/64629051/edit-row-in-vuejs-and-bootstrap-vue
// https://muhimasri.com/blogs/part-4-load-add-update-and-delete-table-rows-using-api-services/
  import { v4 as uuidv4 } from 'uuid';
  import CreateTaskModal from "@/components/task/CreateTaskModal.vue"
  // import EditTaskModal from "@/components/task/EditTaskModal.vue"
  // import TimerClock from "@/components/task/TimerClock.vue"

  export default {
    name: 'TaskList',
    components: {
      CreateTaskModal,
      // EditTaskModal,
      // TimerClock
    },
    created() {
      this.$store.dispatch('tasks/fetchTasks');
    },
    mounted() {
      // Set the initial number of items
      this.totalRows = this.items.length
    },
    data() {
      return {
        fields: [
          { key: 'name', label: 'Nombre', sortable: true, sortDirection: 'desc', type: "text" },
          { key: 'description', label: 'Descripción', sortable: true, sortDirection: 'desc', type: "text" },
          { key: 'priority', label: 'Prioridad', sortable: true, class: 'text-center', type: "select" },
          { key: 'isCompleted', label: 'Completada', sortable: true, sortByFormatted: true, filterByFormatted: true, type: "selectRow" },
          { key: 'actions', label: 'Actions', type: "edit" }
        ],
        edit: false,
        // totalRows: 1,
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15, { value: 100, text: "Todas (100 máx)" }],
        sortBy: '',
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
        firmData: '',
        deleteModal: {
          id: 'delete-modal',
          index: null,
          title: '',
          content: ''
        },
        createModal: {
          id: 'create-modal',
          content: null
        },
        newTask: {
          uuid: uuidv4(),
          title: '',
          description: '',
          priority: 'Baja'
        },
        timerModal: {
          id: 'timer-modal',
          index: null,
          title: '',
          content: ''
        },
        options: [ 'Alta', 'Media', 'Baja',]
      }
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      },
      items: {
        get() {
          var newData = [];
          this.$store.getters['tasks/tasksList'].forEach(function (row) {
            var newRow = {};
            newRow.description = row.description
            newRow.isCompleted = row.isCompleted
            newRow.name = row.name
            newRow.priority = row.priority
            newRow.uuid = row.uuid
            newRow._rowVariant = row._rowVariant
            newRow.isEdit = false;
            newRow.isSelected = false;
            newRow.totalTime = row.total_time;

            newData.push(newRow);
          });

          return newData;
        },
        set(taskList) {
          this.$store.dispatch('tasks/updateTaskList', taskList)
          return taskList;
        }
      },
      totalRows: {
        get() {
          return this.items.length;
        },
        set(value) {
          return value;
        } 
      }
    },
    // watch: {
    //   items(value) {
    //       //this.$store.dispatch('setTestAccounts', value);
    //     console.log('Watching...');
    //       console.log(value);
    //   }
    // },
    methods: {
      llamadadeTiempo(row){
        if (!this.$store.state.timer.isActive){
          var task = {
            id: row.uuid, 
            name: row.name 
          }
          this.$store.dispatch('timer/setTask', task)
          this.$store.dispatch('timer/change')
        }
      },
      editRowHandler(data) {
        this.items[data.index].isEdit = !this.items[data.index].isEdit;
      },
      selectRowHandler(data) {
        this.items[data.index].isSelected = !this.items[data.index].isSelected;
      },
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      toggleEdit(index){
        this.items[index].isEdit = !this.items[index].isEdit;
        this.$forceUpdate();
      },
      infoDeleteModal(item, index, button) {
        this.deleteModal.index = index;
        this.deleteModal.title = `Row index: ${item.name}`
        this.deleteModal.content = item.description
        this.$root.$emit('bv::show::modal', this.deleteModal.id, button)
      },
      resetDeleteModal() {
        this.deleteModal.index = null
        this.deleteModal.title = ''
        this.deleteModal.content = ''
      },
      removeRow(index) {
        console.log(index);
        const currentRow = this.items.filter((item, i) => i == index);
        this.$store.dispatch('tasks/deleteTask', currentRow[0].uuid);
        console.log(currentRow[0]);

        var tasks = this.items.filter((item, i) => i !== index);
        this.$store.dispatch('tasks/updateTaskList', tasks);
      },
      create(button) {
        this.createModal.index = 0;
        this.createModal.title = `Crear nueva Tarea`
        this.createModal.content = 'item.description'
       
        this.$root.$emit('bv::show::modal', this.createModal.id, button)
      },
      resetCreateModal() {
        console.log('Reseting create modal');
        this.createModal.index = null
        this.createModal.title = ''
        this.createModal.content = ''
      },
      createRow(newTask) {
        var newTaskRow = {
          uuid: newTask.uuid, 
          isCompleted: false, 
          name: newTask.title, 
          description: newTask.description, 
          priority: newTask.priority, 
          _rowVariant: 'success' 
        }
        this.$store.dispatch('tasks/addNewTask', newTaskRow)
        // this.items.push(newTaskRow);
        this.totalRows = this.items.length
        this.$emit('input', this.totalRows);
      },
      timer(item, index, button) {
        this.timerModal.index = index;
        this.timerModal.title = ``
        this.timerModal.content = item.description
        this.$root.$emit(this.timerModal.id, button)
        // this.$root.$emit('bv::show::modal', this.timerModal.id, button)
      },
      resetTimerModal() {
        this.timerModal.index = null
        this.timerModal.title = ''
        this.timerModal.content = ''
      },
      addTimer() {
        console.log('Adding time');
        // this.items = this.items.filter((item, i) => i !== index);
        // this.totalRows = this.items.length
        // this.$emit('input', this.totalRows);
      },
      updateTask(index, item) {
        this.$store.dispatch('tasks/updateTask', item);
        this.toggleEdit(index);
      }
    }
  }
</script>
    
<style>
</style>