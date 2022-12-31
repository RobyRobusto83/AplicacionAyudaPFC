import apiConfig from '@/api'
import axios from "axios";

// initial state
const state = {
  document: {
    title: '',
    sections: []
  },
  current_section: {
    identifier: '',
    text: ''
  },
  current_subsection: {
    identifier: '',
    text: ''
  }
};

// mutations
const mutations = {
  SET_DOCUMENT: (state, payload) => {
    state.document.title = payload.title;
    state.document.sections = [];    
    if(payload.sections !== null){
      state.document.sections = payload.sections;
    }
  },
  UPDATE_SECTION: (state) => {
    state.document.sections.forEach(
      function (section) {
        if (section.id == state.current_section.identifier) {
          section.title = state.current_section.text;
        }
      }
    );
    state.current_section.identifier = '';
    state.current_section.text = '';
  },
  UPDATE_CURRENT_SECTION: (state, payload) => {
    state.current_section.identifier = payload.id;
    state.current_section.text = payload.title;
  },
  ADD_NEW_SECTION: (state, payload) => {
    state.document.sections.push(payload);
  },
  DELETE_SECTION: (state, payload) => {
    var newSections = [];
    state.document.sections.forEach(
      function (section) {
        if (section.id !== payload) {
          newSections.push(section);
        }
      }
    );
    state.document.sections = newSections;
  },
  DELETE_SUBSECTION: (state, payload) => {
    var newSections = [];
    state.document.sections.forEach(
      function (section) {
        if (section.id === payload.section) {
          var newSubsections = [];
          section.subsections.forEach(
            function (subsection) {
              if (subsection.id !== payload.subsection) {
                newSubsections.push(subsection);
              }
            }
          );
          section.subsections = newSubsections;
        }
        newSections.push(section);
      }
    );
    state.document.sections = newSections;
  },
  UPDATE_SUBSECTION_TITLE: (state, payload) => {
    state.document.sections.forEach(
      function (section) {
        if (section.id === payload.section) {
          section.subsections.forEach(
            function (subsection) {
              if (subsection.id === payload.subsection) {
                subsection.title = payload.title;
              }
            }
          );
        }
      }
    );
  },
  ADD_NEW_SUBSECTION: (state, payload) => {
    state.document.sections.forEach(
      function (section) {
        if (section.id === payload.section) {
          section.subsections.push({
            id: payload.id, 
            title: payload.title, 
            content: ""
          });
        }
      }
    );
  },
  UPDATE_SUBSECTION_CONTENT: (state, payload) => {
    state.document.sections.forEach(
      function (section) {
        if (section.id === payload.section) {
          section.subsections.forEach(
            function (subsection) {
              if (subsection.id === payload.subsection) {
                subsection.content = payload.content;
              }
            }
          );
        }
      }
    );
  },
  CALL_BACKEND () {
    try {
      var payload = {
        "id": apiConfig.DOCUMENT_UUID,
        "title": state.document.title,
        "sections": state.document.sections,
      };
      axios.post(
        apiConfig.BACKEND_URL + "/pfc/update",
        payload
      );
    } catch (error) {
      console.log(error);
    }
  },
}

// getters
const getters = {
    title(state) {
      return state.document.title;
    },
    content(state) {
      return state.document.sections;
    },
    hasContent(state) {
      return state.document.title !== "";
    }
}

// actions
const actions = {
  updateCurrentSection (context, payload) {
    context.commit('UPDATE_CURRENT_SECTION', payload);
    context.commit('UPDATE_SECTION');
    context.commit('CALL_BACKEND');
  },
  async fetchDocument({ commit }) {
    try {
      const data = await axios.get(
        apiConfig.BACKEND_URL + "/pfc/getContent/" + apiConfig.DOCUMENT_UUID
      );
      commit("SET_DOCUMENT", data.data.document);
    } catch (error) {
      console.log(error);
    }
  },
  addNewSection (context, section) {    
    context.commit('ADD_NEW_SECTION', section);
    context.commit('CALL_BACKEND');
  },
  deleteSection(context, payload) {
    context.commit('DELETE_SECTION', payload);
    context.commit('CALL_BACKEND');
  },
  deleteSubsection(context, payload) {
    context.commit('DELETE_SUBSECTION', payload);
    context.commit('CALL_BACKEND');
  },
  updateSubsectionTitle(context, payload) {
    context.commit('UPDATE_SUBSECTION_TITLE', payload);
    context.commit('CALL_BACKEND');
  },
  addNewSubsection (context, payload) {
    context.commit('ADD_NEW_SUBSECTION', payload);
    context.commit('CALL_BACKEND');
  },
  updateSubsectionContent(context, payload) {
    context.commit('UPDATE_SUBSECTION_CONTENT', payload);
    context.commit('CALL_BACKEND');
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}