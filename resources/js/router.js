import Home from '../views/pages/home.vue'

import St from '../views/pages/st.vue'

import {createRouter , createWebHistory} from 'vue-router'


// 2. Define routes
const routes = [
  { path: '/' ,  component: Home },
  { path: '/app/statistics' ,  component: St},
]

// 3. Create the router instance and pass the `routes` option

const router = createRouter({
    history: createWebHistory(),
    routes
  })


export default router
