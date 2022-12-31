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
    state.document.sections = payload.sections;
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
  }
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
  // fetchDocument ({ commit }) {
  //   document.getDocument(document => {
  //     commit('SET_DOCUMENT', document)
  //   });
  // },
  updateCurrentSection (context, payload) {
    context.commit('UPDATE_CURRENT_SECTION', payload);
    context.commit('UPDATE_SECTION');
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
  addNewSection (context, payload) {
    context.commit('ADD_NEW_SECTION', payload);
  },
  deleteSection(context, payload) {
    context.commit('DELETE_SECTION', payload);
  },
  deleteSubsection(context, payload) {
    context.commit('DELETE_SUBSECTION', payload);
  },
  updateSubsectionTitle(context, payload) {
    context.commit('UPDATE_SUBSECTION_TITLE', payload);
  },
  addNewSubsection (context, payload) {
    context.commit('ADD_NEW_SUBSECTION', payload);
  },
  updateSubsectionContent(context, payload) {
    context.commit('UPDATE_SUBSECTION_CONTENT', payload);
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}