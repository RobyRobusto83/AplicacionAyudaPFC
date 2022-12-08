import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import Home from './pages/Home.vue'
import PFC from './pages/PFC.vue'
import AboutUs from './pages/AboutUs.vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueRouter)

Vue.config.productionTip = false

const routes = [
  { path: '/', component: Home },
  { path: '/pfc', component: PFC },
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

