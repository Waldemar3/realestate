import http from "@/http";

export default {
  namespaced: true,

  state: {
    userData: null
  },

  getters: {
    user: state => state.userData
  },

  mutations: {
    setUserData(state, user) {
      state.userData = user;
    }
  },

  actions: {
    getUserData({ commit }) {
        http
          .get('/user')
          .then(response => {
            commit("setUserData", response.data);
          })
          .catch(() => {
            localStorage.removeItem("authToken");
          });
      },
      sendLoginRequest({ commit }, data) {
        return http
          .post("/login", data)
          .then(response => {
            commit("setUserData", response.data.user);
            localStorage.setItem("authToken", response.data.token);
          });
      },
      sendLogoutRequest({ commit }) {
        return http.post("/logout").then(() => {
          commit("setUserData", null);
          localStorage.removeItem("authToken");
        });
      },
  }
};