<template>
  <div>
    <b-list-group-item href="#" class="flex-column align-items-start">
      <div class="d-flex w-100 justify-content-between">
        <h3 class="mb-1">{{ title }}</h3>
        <small class="text-muted"><b-icon-pencil/></small>
      </div>
      
      <SubchapterPfc
        v-for="subchapter in subchapters"
        :key="subchapter.id"
        v-bind="subchapter"
      />
    </b-list-group-item>
  </div>
</template>

<script>
import SubchapterPfc from './SubchapterPfc.vue'

export default {
  name: 'ChapterPfc',
  components: {
    SubchapterPfc
  },
  props: {
    id: Number,
    title: String,
    subchapters: Array
  }
}
</script>

<style>
</style>