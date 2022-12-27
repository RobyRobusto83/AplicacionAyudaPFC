// import schedule from '@/api/schedule'
import axios from "axios";

// initial state
const state = {
  tasks: []
};

// mutations
const mutations = {
  SET_TASKS: (state, payload) => {
    state.tasks = payload
  },
  ADD_TASK: (state, payload) => {
    state.tasks.unshift(payload)
  },
  // DELETE_TASK: (state, id) => {
  //     state.tasks.filter(task => task.uuid !== id),
  //     state.tasks.splice(task => task.id, 1)
  // }
}

// getters
const getters = {
    tasksList(state) {
      return state.tasks;
    }
}

// actions
const actions = {
  // fetchTasks ({ commit }) {
  //   schedule.getTasks(tasks => {
  //     commit('SET_TASKS', tasks)
  //   })
  // },
  addNewTask (context, newTask) {
      context.commit('ADD_TASK', newTask);
  },
  async fetchTasks ({ commit }) {
    try {
      const data = await axios.get(
        "http://localhost:9980/api/schedule/tasks"
      );
      commit("SET_TASKS", data.data.tasks);
    } catch (error) {
      console.log(error);
    }
  },
  updateTaskList(context, taskList){
    context.commit('SET_TASKS', taskList)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}