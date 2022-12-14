import schedule from '@/api/schedule'

// initial state
const state = {
  tasks: []
};

// getters
const getters = {
    tasksList(state) {
      return state.tasks;
    }
}

// actions
const actions = {
  fetchTasks ({ commit }) {
    schedule.getTasks(tasks => {
      commit('SET_TASKS', tasks)
    })
  },
  addNewTask (context, newTask) {
      context.commit('ADD_TASK', newTask);
  }
}

// mutations
const mutations = {
  SET_TASKS: (state, payload) => {
    state.tasks = payload
  },
  ADD_TASK: (state, payload) => {
    state.tasks.unshift(payload)
  },
  DELETE_TASK: (state, id) => {
      state.tasks.filter(task => task.uuid !== id),
      state.tasks.splice(task => task.id, 1)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}