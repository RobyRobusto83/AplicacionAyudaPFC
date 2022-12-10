<template>
    <div>
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ title }}</h5>
            <small class="text-muted"><b-icon-pencil/></small>
        </div>
        <PFCParagraphItem
            v-for="paragraph in paragraphs"
            :key="paragraph.id"
            v-bind="paragraph"
        />
        <br/>
    </div>    
</template>

<script>
import PFCParagraphItem from './pfc/paragraphItem.vue'

export default {
  name: 'SubchapterPfc',
  components: {
    PFCParagraphItem
  },
  props: {
    id: Number,
    title: String,
    paragraphs: Array
  }
}
</script>

<style>
</style>