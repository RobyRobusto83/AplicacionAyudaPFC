<template>
<div>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#/pfc">PFC</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#/tasks">Tareas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#/about">About us</a>
        </li>
      </ul>
    </div>
    <TimerClock/>  
  </nav>
</div>
</template>

<script>
import TimerClock from "@/components/task/TimerClock.vue"
export default {
  name: 'NavBar',
  components: {
      TimerClock
    },
  props: {}
}
</script>

<style>
</style>
