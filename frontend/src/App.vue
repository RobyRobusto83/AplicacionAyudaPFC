<template>
  <div id="app" class="container">
    <NavBar />

    <div>
      <router-view></router-view>
    </div>

    <footer class="footer">
       <p>&copy; 2022 Roberto Martínez</p>
    </footer>
  </div>
</template>

<script>
import NavBar from './components/Navbar.vue'

export default {
  components: {
    NavBar
  }
}
</script>

<style>
body {
  padding-top: 5rem;
  margin-top:20px;
  background-color:#eee;
}
</style>
