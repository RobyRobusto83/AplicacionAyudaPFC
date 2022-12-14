<template>
    <div>
        <b-form v-if="show">
            <b-form-group
                id="input-group-1"
                label="Nombre"
                label-for="input-1"
            >
                <b-form-input
                id="input-1"
                v-model="form.name"
                required
                ></b-form-input>
            </b-form-group>
    
            <b-form-group id="input-group-2" label="Descripción" label-for="input-2">
                <b-form-textarea
                    id="input-2"
                    v-model="form.description"
                    placeholder="Descripción"
                    rows="3"
                    max-rows="6"
                    required
                ></b-form-textarea>
            </b-form-group>
    
            <b-form-group id="input-group-3" label="Prioridades" label-for="input-3">
                <b-form-select
                id="input-3"
                v-model="form.priority"
                :options="prioritys"
                required
                ></b-form-select>
            </b-form-group>
        </b-form>      
    </div>
    </template>
    
    <script>
    export default {
        props: {
            formData: {
                title: String,
                description: String,
                priority: String
            }
        },
        data() {
            return {
                form: {
                    name: this.formData.title,
                    description: this.formData.description,
                    priority: this.formData.priority
                },
                prioritys: [{ text: 'Seleccione una prioridad', value: null }, 'Alta', 'Media', 'Baja',],
                show: true
            }
        },
        methods: {
            // onSubmit(event) {
            //     event.preventDefault()
            //     console.log('onSubmit')
            //     alert(JSON.stringify(this.form))
            // },
            // onReset(event) {
            //     console.log('onReset')
            //     event.preventDefault()
            // },
            // onClose(event) {
            //     console.log('onReset')
            //     event.preventDefault()
            //     this.$emit('chainClosedEvent', this.form)
            // }
        }
    }
    </script>