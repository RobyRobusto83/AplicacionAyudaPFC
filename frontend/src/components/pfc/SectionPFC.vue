<template>
  <div>
    <b-list-group-item href="#" class="flex-column align-items-start">
      <div class="d-flex w-100 justify-content-between">
        <h3 class="mb-1" v-if="!isEditable">{{ newText }}</h3>
        <div>
          <b-button size="sm" @click="editChanged()" class="mr-1" variant="outline-secondary" v-if="!isEditable"><b-icon-pencil/></b-button>        
          <b-button size="sm" @click="deleteSection(id)" class="mr-1" variant="danger" v-if="!isEditable"><b-icon-trash/></b-button>
        </div>
        <b-form-input v-model="newText" v-if="isEditable"></b-form-input>
        <b-button size="sm" @click="changeTitle(newText)" class="mr-1" variant="primary" v-if="isEditable"><b-icon-check-square/></b-button>
        <b-button size="sm" @click="editChanged()" class="mr-1" variant="outline-secondary" v-if="isEditable"><b-icon-x-square/></b-button>        
      </div>
      
      <SubsectionPfc
        v-for="subsection in subsections"
        :key="subsection.id"
        v-bind="subsection"
        :section="id"
      />

      <div class="d-flex w-100 justify-content-end">
      <h6 class="mb-1 addSubsectionTitle" v-if="!enabledAddSubsection">¿Quieres añadir una nueva subsección?</h6>
      <b-form-input v-model="newSubsection" v-if="enabledAddSubsection"></b-form-input>
      <b-button size="sm" @click="addSubsection(newSubsection)" class="mr-1" variant="primary" v-if="enabledAddSubsection"><b-icon-check-square/></b-button>
      <b-button size="sm" @click="addChangedSubsection()" class="mr-1" variant="outline-secondary" v-if="enabledAddSubsection"><b-icon-x-square/></b-button>   
      <b-button size="sm" @click="addChangedSubsection()" class="mr-1" variant="primary" v-if="!enabledAddSubsection">Añadir<b-icon-plus/></b-button>
    </div>
    </b-list-group-item>
  </div>
</template>

<script>
import { v4 as uuidv4 } from 'uuid';
import SubsectionPfc from './SubsectionPFC.vue'

export default {
  name: 'SectionPfc',
  components: {
    SubsectionPfc
  },
  props: {
    id: String,
    title: String,
    subsections: Array
  },
  data() {
    return {
      isEditable: false,
      newText: '',
      enabledAddSubsection: false,
      newSection: '',
    }
  },
  mounted() {
    this.newText = this.title
  },
  computed: {
    targetTitle() {
      return this.title
    }
  },
  methods: {
    changeTitle(payload) {
      this.isEditable = !this.isEditable;
      var currentSection = {
        id: this.id,
        title: payload
      }
      this.$store.dispatch('pfc/updateCurrentSection', currentSection);
      this.$emit("update-new-text", payload) ;
    },
    editChanged() {
      this.isEditable = !this.isEditable;
    },
    deleteSection(payload) {
      this.$store.dispatch('pfc/deleteSection', payload);
    },
    addChangedSubsection() {
      this.enabledAddSubsection = !this.enabledAddSubsection;
    },
    addSubsection(payload) {
      this.enabledAddSubsection= !this.enabledAddSubsection;
      var newSubsection = {
        section: this.id,
        id: uuidv4(),
        title: payload,
        subsections: []
      }
      this.$store.dispatch('pfc/addNewSubsection', newSubsection);
    },
  },
}
</script>

<style>
.addSectionTitle{
  margin-right: 10px;
}
</style>