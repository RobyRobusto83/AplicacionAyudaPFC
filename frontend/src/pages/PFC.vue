<template>
  <div>
    <b-list-group>
      <ChapterPfc
        v-for="chapter in pfc.chapters"
        :key="chapter.id"
        v-bind="chapter"
      />
    </b-list-group>
  </div>
</template>
  
<script>
import ChapterPfc from '../components/ChapterPfc.vue'
import dataPFC from '../data/pfc_data.js'

export default {
  name: 'PFC',
  components: {
    ChapterPfc
  },
  data() {
    return {
      pfc: dataPFC,
      active_chapter: 1
    }
  }
}
</script>
  
<style>
.test {
    color: red;
}
</style>