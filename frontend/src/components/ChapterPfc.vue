<template>
  <b-list-group-item href="#" class="flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{ chapter}}</h5>
      <small class="text-muted">{{ days}}</small>
    </div>

    <p class="mb-1">{{ paragraph }}</p>
    <p class="mb-1">{{ paragraph }}</p>
    <p class="mb-1">{{ paragraph }}</p>

    <small class="text-muted">{{ subparagraph }}</small>
    <small class="text-muted">{{ subparagraph }}</small>
    <small class="text-muted">{{ subparagraph }}</small>
    <small class="text-muted">{{ subparagraph }}</small>
  </b-list-group-item>
</template>

<script>
export default {
  name: 'ChapterPfc',
  props: {
    chapter: String,
    days: String,
    paragraph: String,
    subparagraph: String
  }
}
</script>

<style>
</style>