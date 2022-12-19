import Vue from 'vue'
import Vuex from 'vuex'

// https://www.positronx.io/vue-js-vuex-state-management-tutorial-by-example/
// https://codesandbox.io/s/vue2-vuex-to-vue3-vuex-composition-api-c44cg?file=/src/composition-api/useStateHandle.js
// https://itnext.io/managing-state-in-vue-js-with-vuex-f036fd71f432
// https://markus.oberlehner.net/blog/how-to-structure-a-complex-vuex-store/ <== REVISAME

import tasks from '@/store/modules/tasks'
import pfc from '@/store/modules/pfc'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    state: {
    },
    mutations: {
    },
    actions: {
    },
    modules: {
        tasks,
        pfc
    },
    strict: debug
})
