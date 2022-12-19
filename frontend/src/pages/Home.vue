<template>
  <PFCViewer />
</template>

<script>
import PFCViewer from '@/components/pfcViewer/PFCViewer.vue'

export default {
  name: 'App',
  components: {
    PFCViewer
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.starter-template {
  padding: 3rem 1.5rem;
  text-align: center;
}

</style>
