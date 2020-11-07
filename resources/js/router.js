import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


const routes = [
    {
      path: '/Home',
      name: 'Home',
      component: () => import( './Views/home.vue')
    },
      {
        path: '*',
        component: () => import( './Views/404.vue')
      }
  ]

  const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
  })

  export default router
