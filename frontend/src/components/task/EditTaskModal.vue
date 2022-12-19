<template>
    <b-modal :id="id" :title="title">
      <template #modal-header="{ close }">
        <!-- Emulate built in modal header close button action -->
        <h5>Editar tarea</h5>
        <button type="button" aria-label="Close" class="close" @click="close()">×</button>
      </template>

      <template>
        <b-form v-if="show">
            <b-form-group
                id="input-group-1"
                label="Nombre"
                label-for="input-1"
            >
                <b-form-input
                id="input-1"
                v-model="formUpd.title"
                required
                ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Descripción" label-for="input-2">
                <b-form-textarea
                    id="input-2"
                    v-model="formUpd.description"
                    placeholder="Descripción"
                    rows="3"
                    max-rows="6"
                    required
                ></b-form-textarea>
            </b-form-group>

            <b-form-group id="input-group-3" label="Prioridades" label-for="input-3">
                <b-form-select
                id="input-3"
                v-model="formUpd.priority"
                :options="prioritys"
                required
                ></b-form-select>
            </b-form-group>
        </b-form>      
      </template>

      <template #modal-footer="{}">
        <!-- Emulate built in modal footer ok and cancel button actions -->
        <b-button size="sm" variant="success" @click="onOk()">Guardar</b-button>
        <!-- Button with custom close trigger value -->
        <b-button size="sm" variant="outline-secondary" @click="onHide()">Cancelar</b-button>
      </template>
    </b-modal> 
</template>

<script>
export default {
    props: {
        id: String,
        title: String,
        formUpdData: {
            uuid: String,
            title: String,
            description: String,
            priority: String
        }
    },
    data() {
        return {
            formUpd: {
                uuid: this.formUpdData.uuid,
                title: this.formUpdData.title,
                description: this.formUpdData.description,
                priority: this.formUpdData.priority
            },
            prioritys: [{ text: 'Seleccione una prioridad', value: null }, 'Alta', 'Media', 'Baja',],
            show: true
        }
    },
    methods: {
        onOk() {
            this.$emit('updatedTask', this.formUpd);
            this.$root.$emit('bv::hide::modal', this.id);
        },
        onHide() {
            this.$emit('resetedUpdateTask');
            this.$root.$emit('bv::hide::modal', this.id);
        },
    }, 
    mount () {
        console.log('Visual data XXXX');
        console.log(this.formUpdData);
        this.formUpd.uuid = this.formUpdData.uuid;
        this.formUpd.title = this.formUpdData.title;
        this.formUpd.description = this.formUpdData.description;
        this.formUpd.priority = this.formUpdData.priority;
        console.log('Updated data');
        console.log(this.formUpd);
        this.$forceUpdate();
    }
}
</script>