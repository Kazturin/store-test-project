import { createStore } from "vuex";
import axiosClient from "../axios";


const store = createStore({
  state: {
    user: {
      data: {},
      token: sessionStorage.getItem("TOKEN"),
    },
    products: {
      loading: false,
      links: [],
      data: []
    },
    shoppingCart:[],
    orders: {
      loading: false,
      links: [],
      data: []
    },
  },
  getters: {},
  actions: {

    register({commit}, user) {
      return axiosClient.post('/register', user)
        .then(({data}) => {
          commit('setUser', data.user);
          commit('setToken', data.token)
          return data;
        })
    },
      login({commit}, user) {

          return axiosClient.post('/login', user)
              .then(({data}) => {
                  console.log(data)
                  commit('setUser', data.user);
                  commit('setToken', data.token);
                  return data;
              }).catch(error => {
                  throw error;
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
        commit('setUser', res.data)
          return res.data;
      })
    },
    getProducts({commit}) {
      commit('productLoading', true)
      return axiosClient.get(`/products`)
      .then((res) => {
        commit('productLoading', false)
        commit('setProducts', res.data)
        return res;
      })
      .catch(error => {
        commit('productLoading', false)
        return error;
      })
    },
    getOrders({commit},payload) {
          commit('ordersLoading', true)
        console.log(payload)
          return axiosClient.get(`/orders`, payload)
              .then((res) => {
                  console.log('orders')
                  console.log(res.data)
                  commit('ordersLoading', false)
                  commit('setOrders', res.data.data)
                  return res;
              })

    },
    checkout({},payload){
       return  axiosClient.post("/checkout", payload).then((res) => {
            return res;
        }).catch(error => {
           return error;
       });
    }
  },
  mutations: {
    logout: (state) => {
      state.user.token = null;
      state.user.data = {};
      sessionStorage.removeItem("TOKEN");
    },

    setUser: (state, user) => {
      state.user.data = user;
    },
    setToken: (state, token) => {
      state.user.token = token;
      sessionStorage.setItem('TOKEN', token);
    },
    productLoading: (state, loading) => {
      state.products.loading = loading;
    },
    setProducts: (state, data) => {
      state.products.data = data.data
    },
    ordersLoading: (state, loading) => {
      state.orders.loading = loading;
    },
    setOrders: (state, data) => {
      state.orders.data = data
    },
    clearBasket(state){
      state.shoppingCart = [];
    },
    pushProductToBasket(state, data){
       state.shoppingCart.push(data);
    },
  }

});

export default store;
