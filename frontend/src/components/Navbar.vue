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
          <a class="nav-link" href="#/Working">Working</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#/about">About us</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Buscar tarea" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </div>
  </nav>
</div>
</template>

<script>
export default {
  name: 'NavBar',
  props: {}
}
</script>

<style>
</style>
