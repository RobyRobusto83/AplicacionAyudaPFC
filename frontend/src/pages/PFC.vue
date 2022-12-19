<template>
  <div>
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
</template>
  
<script>
import { v4 as uuidv4 } from 'uuid';
import SectionPfc from '@/components/pfc/SectionPFC.vue'

export default {
  name: 'PFC',
  components: {
    SectionPfc
  },
  data() {
    return {
      enabledAddSection: false,
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
    }
  }
}
</script>
  