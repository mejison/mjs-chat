import Vue from 'vue'
import VueRouter from 'vue-router'
import VueCookie from 'vue-cookie'

Vue.use(VueRouter)

import {
  Welcome,
  NotFound,
  Login,
  Register,
  Dashboard,
} from '../views'

import {
  Public,
} from '../layouts'

const isAuth = (to, from, next) => {
  let token = VueCookie.get('token')  
  token ? next() : next({name: 'welcome'})
}

export default new VueRouter({
  mode: 'history',  
  routes: [
    {
      path: '', 
      name: 'home',
      component: Public,
      children: [
        {
          path: '',
          name: 'dashboard',
          component: Dashboard,
          beforeEnter: isAuth,
          meta: {
            transition: 'fade',
          }
        },
        {
          path: '',
          name: 'welcome',
          component: Welcome,         
          meta: {
            transition: 'slide-right',
          }
        },
        {
          path: 'signin',
          name: 'signin',
          component: Login, 
          meta: {
            transition: 'slide-left',
          }         
        },
        {
          path: 'signup',
          name: 'signup',
          component: Register,
          meta: {
            transition: 'slide-right',
          }
        },
      ]
    },    
    {
      path: '*',
      name: 'not-found',
      component: NotFound,
      meta: {
        transition: 'slide-right',
      }
    }
  ]
});