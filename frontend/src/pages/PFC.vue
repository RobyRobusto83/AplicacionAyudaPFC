<template>
  <div>
  <div class="starter-template" v-if="!$store.getters['pfc/hasContent']">
      <p class="lead">Define el PFC</p>
      <b-form-input v-model="newPFC"></b-form-input>
        <b-button size="sm" @click="addPFC()" class="mr-1" variant="primary"><b-icon-check-square/></b-button>       
  </div>

  <div v-if="$store.getters['pfc/hasContent']">
    <h2>{{ $store.getters['pfc/title'] }}</h2>
    <b-list-group>
      <SectionPfc
        v-for="section in $store.getters['pfc/content']"
        :key="section.id"
        v-bind="section"
      />

      <div class="d-flex w-100 justify-content-end">
        <h5 class="mb-1 addSectionTitle" v-if="!enabledAddSection">¿Quieres añadir una nueva sección?</h5>
        <b-form-input v-model="newSection" v-if="enabledAddSection"></b-form-input>
        <b-button size="sm" @click="addSection(newSection)" class="mr-1" variant="primary" v-if="enabledAddSection"><b-icon-check-square/></b-button>
        <b-button size="sm" @click="addChangedSection()" class="mr-1" variant="outline-secondary" v-if="enabledAddSection"><b-icon-x-square/></b-button>  
        <b-button size="sm" @click="addChangedSection()" class="mr-1" variant="primary" v-if="!enabledAddSection">Añadir<b-icon-plus/></b-button>
      </div>
    </b-list-group>
    
  </div>
  </div>
</template>
  
<script>
import { v4 as uuidv4 } from 'uuid';
import SectionPfc from '@/components/pfc/SectionPFC.vue'
import apiConfig from '@/api'
import axios from "axios";

export default {
  name: 'PFC',
  components: {
    SectionPfc
  },
  data() {
    return {
      enabledAddSection: false,
      newPFC:''
    }
  },
  created() {
    this.$store.dispatch('pfc/fetchDocument');
  },
  methods: {
    addChangedSection() {
      this.enabledAddSection = !this.enabledAddSection;
    },
    addSection(payload) {
      this.enabledAddSection = !this.enabledAddSection;
      var newSection = {
        id: uuidv4(),
        title: payload,
        subsections: []
      }
      this.$store.dispatch('pfc/addNewSection', newSection);
    },
    addPFC(){
      try {
        // Preparar la variable para conectar con axios
        var payload = {
          "id": apiConfig.DOCUMENT_UUID,
          "title": this.newPFC
        };
        // Realizar la llamada a axios mediante POST
        axios.post(
          apiConfig.BACKEND_URL + "/pfc/new",
          payload
        );
        // Recargar documento
        this.$store.dispatch('pfc/fetchDocument');

      } catch (error) {
        console.log(error);
      }
    }
  }
}
</script>
  