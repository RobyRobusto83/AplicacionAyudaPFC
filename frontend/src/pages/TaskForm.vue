<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Nombre de la Tarea"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="form.itemTitle"
          type="name"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Descripción" label-for="input-2">
          <b-form-textarea
              id="input-2"
              v-model="form.itemDescription"
              placeholder="Descripción"
              rows="3"
              max-rows="6"
              required
          ></b-form-textarea>
      </b-form-group>

      <b-form-group id="input-group-3" label="Prioridades" label-for="input-3">
        <b-form-select
          id="input-3"
          v-model="form.itemPriority"
          :options="prioritys"
          required
        ></b-form-select>
      </b-form-group>

      <b-button type="submit" variant="primary">Guardar</b-button>
      <b-button type="reset" variant="danger">Borrar</b-button>
    </b-form>      
    <a href="#/tasks" data-bs-toggle="tooltip" data-bs-placement="top" title="Guardar"><b-button type="submit" variant="primary">Volver</b-button></a>
  </div>
</template>

<script>
//import TaskItem from '@/components/TaskItem.vue'

  export default {

    data() {
      return {
        prioritys: [{ text: 'Seleccione una prioridad', value: null }, 'Alta', 'Media', 'Baja',],
        show: true
      }
    },
    methods: {
      onSubmit(event) {
        console.log('Submmiting form')
        event.preventDefault()
        alert(JSON.stringify(this.form))
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>