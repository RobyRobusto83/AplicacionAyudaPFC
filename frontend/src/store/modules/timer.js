// initial state
const state = {
  isActive: false,
  taskName:'',
  taskId:''
};

// mutations
const mutations = {
    CHANGE_ACTIVATION: (state) => {
      state.isActive = !state.isActive;
    },
    SET_TASK: (state, payload) => {
        state.taskName = payload['name'];
        state.taskId = payload['id'];
      }
}

// getters
const getters = {
    isActive(state) {
      return state.isActive;
    },
}

// actions
const actions = {
  change (context) {
    context.commit('CHANGE_ACTIVATION');
  },
  setTask (context, payload) {
    context.commit('SET_TASK', payload);
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}