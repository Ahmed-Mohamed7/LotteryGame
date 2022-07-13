import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
  state: {
    user: {
      data:  sessionStorage.getItem("User"),
      token: sessionStorage.getItem("TOKEN"),
    },
    dashboard: {
      loading: false,
      data: {}
    },
    box: {
      loading: false,
      data: {}
    },
    profile:{
      loading :false,
      data:{}
    },
    surveys: {
      loading: false,
      links: [],
      data: []
    },
    currentSurvey: {
      data: {},
      loading: false,
    },
    userBoxes : {
      data:{},
      loading:false,
    }
  },
  getters: {},
  actions: {

    register({commit}, user) {
      return axiosClient.post('auth/register', user)
        .then(({data}) => {
          commit('setUser', data.response.user);
          commit('setToken', data.response.token)
          return data;
        })
    },
    login({commit}, user) {
      // console.log(user);
      return axiosClient.post('auth/login', user)
        .then(({data}) => {
          commit('setUser', data.response.user);
          commit('setToken', data.response.token)
          return data;
        })
    },
    logout({commit}) {
      return axiosClient.post('/logout')
        .then(response => {
          commit('logout')
          return response;
        })
    },
    getUser({commit}) {
      return axiosClient.get('/user')
      .then(res => {
        console.log(res);
        commit('setUser', res.data)
      })
    },
    getDashboardData({commit}) {
      commit('dashboardLoading', true)
      return axiosClient.get(`/box`)
      .then((res) => {
        commit('dashboardLoading', false)
        commit('setDashboardData', res.data)
        console.log(res.data);
        return res;
      })
      .catch(error => {
        commit('dashboardLoading', false)
        return error;
      })

    },
    getProfile({ commit }) {
      commit('setProfileLoading', true)
      return axiosClient.get('profile').then(({data}) => {
        // console.log(data);
        commit('setProfileLoading', false)
        commit('setUser', data.response);
        return data;
      });
    },
    getUserBoxes({ commit },id) {
      return axiosClient.get(`userBoxes/${id}`).then((res) => {
        console.log("a",id);
        commit('setUserBoxes', res.data);
        return res;
      });
    },
    getBoxById({ commit }, id) {
      
      commit("BoxLoading", true);
      return axiosClient
        .get(`/box/${id}`)
        .then((res) => {
          console.log(res.data);
          commit("setCurrentBox", [res.data.response.box,res.data.response.price]);
          commit("BoxLoading", false);
          console.log(res.data.response.box);
          return res;
        })
        .catch((err) => {
          commit("setCurrentSurveyLoading", false);
          throw err;
        });
    },
    getSurveyBySlug({ commit }, slug) {
      commit("setCurrentSurveyLoading", true);
      return axiosClient
        .get(`/survey-by-slug/${slug}`)
        .then((res) => {
          commit("setCurrentSurvey", res.data);
          commit("setCurrentSurveyLoading", false);
          return res;
        })
        .catch((err) => {
          commit("setCurrentSurveyLoading", false);
          throw err;
        });
    },
    saveSurvey({ commit, dispatch }, survey) {

      delete survey.image_url;

      let response;
      if (survey.id) {
        response = axiosClient
          .put(`/survey/${survey.id}`, survey)
          .then((res) => {
            commit('setCurrentSurvey', res.data)
            return res;
          });
      } else {
        response = axiosClient.post("/survey", survey).then((res) => {
          commit('setCurrentSurvey', res.data)
          return res;
        });
      }

      return response;
    },
  
  },
  mutations: {
    logout: (state) => {
      state.user.token = null;
      state.user.data = {};
      sessionStorage.removeItem("TOKEN");
    },

    setUser: (state, user) => {
      state.user.data = user;
      sessionStorage.setItem('User', user);
    },
    setToken: (state, token) => {
      state.user.token = token;
      sessionStorage.setItem('TOKEN', token);
    },
    dashboardLoading: (state, loading) => {
      state.dashboard.loading = loading;
    },
    setDashboardData: (state, data) => {
      console.log(data);
      state.dashboard.data = data
    },
    BoxLoading: (state, loading) => {
      state.box.loading = loading;
    },
    setCurrentBox: (state, data) => {
      console.log(data);
      state.box.data = data
    },
    setProfileLoading: (state, loading) => {
      state.profile.loading = loading;
    },
    setUserBoxes: (state, data) => {
      state.userBoxes.data = data
    },
    setSurveys: (state, surveys) => {
      state.surveys.links = surveys.meta.links;
      state.surveys.data = surveys.data;
    },
    setCurrentSurveyLoading: (state, loading) => {
      state.currentSurvey.loading = loading;
    },
    setCurrentSurvey: (state, data) => {
      console.log(data);
      state.currentSurvey.data = data;
    },
    notify: (state, {message, type}) => {
      state.notification.show = true;
      state.notification.type = type;
      state.notification.message = message;
      setTimeout(() => {
        state.notification.show = false;
      }, 3000)
    },
  },
  modules: {},
});

export default store;
