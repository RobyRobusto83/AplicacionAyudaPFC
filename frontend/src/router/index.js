import Vue from "vue";
import VueRouter from "vue-router";

import Home from '@/pages/Home'
import PFC from '@/pages/PFC'
import TaskList from '@/pages/Tasks'
import AboutUs from '@/pages/AboutUs'
import TaskForm from '@/pages/TaskForm'

Vue.use(VueRouter);

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
export default router;