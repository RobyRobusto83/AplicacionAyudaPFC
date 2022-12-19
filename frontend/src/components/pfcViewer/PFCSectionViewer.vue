<template>
    <div>
        <div>
          <h3>{{ newText }}</h3>     
        </div>
        
        <PFCSubsectionViewer
          v-for="subsection in subsections"
          :key="subsection.id"
          v-bind="subsection"
        />
    </div>
  </template>
  
  <script>
  import PFCSubsectionViewer from './PFCSubsectionViewer.vue'
  
  export default {
    name: 'PFCSectionViewer',
    components: {
      PFCSubsectionViewer
    },
    props: {
      id: String,
      title: String,
      subsections: Array
    },
    data() {
      return {
        newText: ''
      }
    },
    mounted() {
      this.newText = this.title
    },
    computed: {
      targetTitle() {
        return this.title
      }
    }
  }
  </script>
  
  <style>
  </style>