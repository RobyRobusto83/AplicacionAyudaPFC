<template>
<div>
    <div class="d-flex w-100 justify-content-start">
        <small class="text-muted">{{ content }}</small>
        <small class="text-muted"><b-icon-pencil/></small>
        <br/>
    </div>
</div>
</template>

<script>
export default {
  name: 'ParagraphPfc',
  props: {
    id: Number,
    content: String
  },
  methods: {
    showModal () {
      // how to show the modal
    }
  },
}
</script>

<style>
</style>