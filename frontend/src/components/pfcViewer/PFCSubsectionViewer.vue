<template>
    <div>
      <div>
        <h5>{{ newText }}</h5>
      </div>
      <PFCFreeTextViewer :id="id" :content="content" />
    </div>    
  </template>
  
  <script>
  import PFCFreeTextViewer from './PFCFreeTextViewer.vue'
  
  export default {
    name: 'PFCSubsectionViewer',
    components: {
      PFCFreeTextViewer
    },
    props: {
      id: String,
      title: String,
      content: String
    },
    data() {
      return {
        isEditable: false,
        newText: '',
        enabledAdd: false,
        newSubsection: '¿Quieres añadir una nueva subsección?',
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
        var currentChapter = {
          id: this.id,
          title: payload
        }
        this.$store.dispatch('pfc/updateCurrentChapter', currentChapter);
        this.$emit("update-new-text", payload) ;
      },
      editChanged() {
        this.isEditable = !this.isEditable;
      },
      addChanged() {
        console.log('Aquiiiii');
        this.enabledAdd = !this.enabledAdd;
      },
      addSubsection(payload) {
        console.log(payload);
      }
    },
  }
  </script>
  
  <style>
  </style>