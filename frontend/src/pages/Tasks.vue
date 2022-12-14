<template>
<div>
<b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <b-col lg="6" class="my-1">
        <b-form-group
          label="Ordena"
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
                <option value="">sin orden</option>
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
          label="Orden"
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
          label="Filtrar"
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
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Limpiar</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col lg="6" class="my-1">
        <b-form-group
          v-model="sortDirection"
          label="Filtrar por"
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
          label="Por página"
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
      <template #cell(actions)="row">
        <b-button size="sm"  @click="infoEditModal(row.item, row.index, $event.target)" class="mr-1" variant="outline-primary">
            <b-icon icon="pen-fill"/>
        </b-button>
        <b-button size="sm" @click="infoDeleteModal(row.item, row.index, $event.target)" class="mr-1" variant="outline-danger">
            <b-icon icon="trash"/>
        </b-button>
        <b-button size="sm" @click="timer(row.item, row.index, $event.target)" class="mr-1" variant="outline-success">
            <b-icon icon="clock"/>
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
    <EditTaskModal :id="editModal.id" :title="editModal.title" v-bind:formData="updateTask" @createdTask="updateRow" @resetedNewTask="resetUpdateModal"/>
    

  <b-modal :id="timerModal.id" :title="timerModal.title" @hide="resetTimerModal" @ok="addTimer(timerModal.index)">
    <TimerClock />
</b-modal>
</b-container>
    </div>
</template>
    
<script>  
  import { v4 as uuidv4 } from 'uuid';
  import CreateTaskModal from "@/components/task/CreateTaskModal.vue"
  import EditTaskModal from "@/components/task/EditTaskModal.vue"
  // import TaskForm from "@/components/task/TaskForm.vue"
  import TimerClock from "@/components/task/TimerClock.vue"

  export default {
    name: 'TaskList',
    components: {
      CreateTaskModal,
      // TaskForm,
      TimerClock,
      EditTaskModal
    },
    created() {
      this.$store.dispatch('tasks/fetchTasks');
        this.totalRows = this.items.length
        this.$emit('input', this.totalRows);
    },
    mounted() {
      // Set the initial number of items
      this.totalRows = this.items.length
    },
    data() {
      return {
        fields: [
          { key: 'name', label: 'Nombre', sortable: true, sortDirection: 'desc' },
          { key: 'description', label: 'Descripción', sortable: true, sortDirection: 'desc' },
          { key: 'priority', label: 'Prioridad', sortable: true, class: 'text-center' },
          {
            key: 'isCompleted',
            label: 'Completada',
            formatter: (value) => {
              return value ? 'Yes' : 'No'
            },
            sortable: true,
            sortByFormatted: true,
            filterByFormatted: true
          },
          { key: 'actions', label: 'Actions' }
        ],
        totalRows: 1,
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15, { value: 100, text: "Mostrar todas" }],
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
        editModal: {
          id: 'edit-modal',
          content: null
        },
        updateTask: {
          id: uuidv4(),
          title: '',
          description: '',
          priority: ''
        },
        timerModal: {
          id: 'timer-modal',
          index: null,
          title: '',
          content: ''
        }
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
      items() {
        return this.$store.state.tasks.tasks
      }
    },
    methods: {
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
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
        console.log(currentRow[0]);
        // this.items = this.items.filter((item, i) => i !== index);
        // this.totalRows = this.items.length
        // this.$emit('input', this.totalRows);
      },
      create(button) {
        this.createModal.index = 0;
        this.createModal.title = `Crear nueva Tarea`
        this.createModal.content = 'item.description'
        this.form = {
          itemTitle: 'Test',
          itemDescription: 'Testing',
          itepPriority: 'Baja'
        }
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
      infoEditModal(item, index, button) {
        this.editModal.index = 0;
        this.editModal.title = `Modificar Tarea`
        this.editModal.content = 'item.description'
        this.updateTask = {
          itemTitle: 'Updatet',
          itemDescription: 'Changing',
          itepPriority: 'Alta'
        }
        this.$emit('input', this.updateTask);
        this.$root.$emit('bv::show::modal', this.editModal.id, button)
      },
      editRow(event) {
        console.log('Editing task');
        console.log(event);
        console.log(this.form);
        event.preventDefault()
        alert(JSON.stringify(this.newTask))
        // this.items = this.items.filter((item, i) => i !== index);
        // this.totalRows = this.items.length
        // this.$emit('input', this.totalRows);
      },
      resetEditModal() {
        console.log('Reseting edit modal');
        this.editModalModal.index = null
        this.editModalModal.title = ''
        this.editModalModal.content = ''
      },
      timer(item, index, button) {
        this.timerModal.index = index;
        this.timerModal.title = ``
        this.timerModal.content = item.description
        this.$root.$emit('bv::show::modal', this.timerModal.id, button)
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
      }
    }
  }
</script>
    
<style>
</style>