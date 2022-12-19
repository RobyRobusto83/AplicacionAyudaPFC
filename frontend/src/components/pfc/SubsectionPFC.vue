<template>
  <div>
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1" v-if="!isEditable">{{ newText }}</h5>
      <div>
        <b-button size="sm" @click="editChanged()" class="mr-1" variant="outline-secondary" v-if="!isEditable"><b-icon-pencil/></b-button>      
        <b-button size="sm" @click="deleteSubsection(id)" class="mr-1" variant="danger" v-if="!isEditable"><b-icon-trash/></b-button>
      </div>
      <b-form-input v-model="newText" v-if="isEditable"></b-form-input>
      <b-button size="sm" @click="changeTitle(newText)" class="mr-1" variant="primary" v-if="isEditable"><b-icon-check-square/></b-button>
      <b-button size="sm" @click="editChanged()" class="mr-1" variant="outline-secondary" v-if="isEditable"><b-icon-x-square/></b-button>
    </div>

    <FreeTextPFC :id="id" :content="content" />

  </div>    
</template>

<script>
import FreeTextPFC from './FreeTextPFC.vue'

export default {
  name: 'SubsectionPfc',
  components: {
    FreeTextPFC
  },
  props: {
    id: String,
    title: String,
    content: String,
    section: String
  },
  data() {
    return {
      isEditable: false,
      newText: '',
      enabledAdd: false,
      newSubsection: '',
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
      this.$store.dispatch('pfc/updateSubsectionTitle', {section: this.section, subsection: this.id, title: payload});
      this.$emit("update-new-text", payload) ;
    },
    editChanged() {
      this.isEditable = !this.isEditable;
    },
    deleteSubsection(payload) {
      this.$store.dispatch('pfc/deleteSubsection', {section: this.section, subsection: payload});
    }
  },
}
</script>

<style>
.addSubsectionTitle{
  margin-right: 10px;
}
</style>