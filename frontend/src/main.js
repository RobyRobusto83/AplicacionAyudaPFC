import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import Home from './pages/Home.vue'
import PFC from './pages/PFC.vue'
import TaskList from './pages/Tasks.vue'
import WorkingArea from './pages/Working.vue'
import TimerPage from './pages/TimerPage.vue'
import TaskForm from './pages/TaskForm.vue'
import AboutUs from './pages/AboutUs.vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'bootstrap/dist/js/bootstrap.bundle.js'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueRouter)

Vue.config.productionTip = false

const routes = [
  { path: '/', component: Home },
  { path: '/pfc', component: PFC },
  { path: '/tasks', component: TaskList },
  { path: '/Working', component: WorkingArea },
  { path: '/TaskForm', component: TaskForm },
  { path: '/timer', component: TimerPage },
  { path: '/about', component: AboutUs },
]
const router = new VueRouter({
    routes
})

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})

