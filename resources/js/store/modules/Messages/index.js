import api from "../../../api";

const messages = {
  namespaced: true,
  state: {
    dialogs: [],
    dialog: {},
    current: false,
    messages: [],
  },
  getters: {},
  actions: {
    getDialogs({ commit }) {
      return api.getDialogs().then(r => {
        let { data } = r.data
        commit('setDailogs', data);
      })
    },
    getDialog({ commit }, dialog_id) {
      return api.getDialog(dialog_id).then(r => {
        let { data } = r.data
        commit('setDialog', data);
      })
    },
    setCurrentDialog({ commit }, payload) {
      commit('setCurrentDialog', payload)
    },
    getMessages({ commit }, payload) {
      return api.getMessages(payload).then(r => {
        let { data } = r.data
        commit('setMessages', data);
      })
    },
    sendMessage({ commit }, payload) {
      return api.sendMessage(payload.dialog, payload.data)
    }
  },
  mutations: {
    setDailogs(state, payload) {
      state.dialogs = payload
    },
    setCurrentDialog(state, payload) {
      state.current = payload
    },
    setMessages(state, payload) {
      state.messages = payload
    },
    setDialog(state, payload) {
      state.dialog = payload
    },
  },
}

export default messages