import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'

import App from './App.vue'
import Home from './pages/Home.vue'
import PFC from './pages/PFC.vue'
import TaskList from './pages/Tasks.vue'
import AboutUs from './pages/AboutUs.vue'
import TaskForm from './pages/TaskForm.vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'bootstrap/dist/js/bootstrap.min.js'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueRouter)
Vue.use(Vuex)

Vue.config.productionTip = false

const routes = [
  { path: '/', component: Home },
  { path: '/pfc', component: PFC },
  { path: '/tasks', component: TaskList },
  { path: '/task', component: TaskForm },
  { path: '/about', component: AboutUs },
]
const router = new VueRouter({
    routes
})

// const store = new Vuex.Store({
//   state: {
//     count: 0
//   },
//   mutations: {
//     increment (state) {
//       state.count++
//     }
//   }
// })

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})

