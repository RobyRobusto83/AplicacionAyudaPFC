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
  UPDATE_TASKS: (state, payload) => {
    state.tasks = payload
  },
  UPDATE_TASK:(state, payload) => {
    state.tasks.forEach(
      function (task) {
        if (task.uuid === payload.uuid) {
          task.name = payload.name,
          task.description = payload.description,
          task.priority = payload.priority,
          task.isCompleted = payload.isCompleted,
          task._rowVariant = payload._rowVariant
        }
      }
    );
  }
}

// getters
const getters = {
    tasksList(state) {
      return state.tasks;
    }
}

// actions
const actions = {
  // getTasks ({ commit }) {
  //   return commit("GET_TASKS")
  // },
  async addNewTask (context, newTask) {      
      try {
        await axios.post(
          "http://localhost:9980/api/schedule/newTask",
          {
            "id": newTask.uuid,
            "name": newTask.name,
            "description": newTask.description,
            "priority": newTask.priority
          }
        );
        context.commit('ADD_TASK', newTask);
      } catch (error) {
        console.log(error);
      }
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
  },
 
 async updateTask (context, updateTask) {      
    try {
      var payload = {
        "id": updateTask.uuid,
        "name": updateTask.name,
        "description": updateTask.description,
        "priority": updateTask.priority,
        "total_time": 0,
        "done": updateTask.isCompleted,
        "color": updateTask._rowVariant
      };
      axios.post(
        "http://localhost:9980/api/schedule/updateTask",
        payload
      );
      context.commit('UPDATE_TASK', updateTask);
    } catch (error) {
      console.log(error);
    }
  },

  async deleteTask (context, taskId) {      
    try {
      axios.delete(
        "http://localhost:9980/api/schedule/deleteTask/" + taskId
      );
    } catch (error) {
      console.log(error);
    }
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}