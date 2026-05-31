import { createRouter, createWebHistory } from 'vue-router'

import Login from '../views/Login.vue'

import DashboardAdmin from '../views/Admin/dashboardAdmin.vue'
import KelolaProduk from '../views/Admin/kelolaproduk.vue'
import KelolaPesanan from '../views/Admin/kelolapesanan.vue'

import DashboardUser from '../views/User/dashboard.vue'
import Order from '../views/User/order.vue'

const routes = [
  {
    path: '/',
    component: Login
  },
  {
  path: '/login',
  name: 'login',
  component: () => import('../views/Login.vue')
},
  {
    path: '/admin/dashboard',
    component: DashboardAdmin
  },
  {
    path: '/admin/produk',
    component: KelolaProduk
  },
  {
    path: '/admin/pesanan',
    component: KelolaPesanan
  },
  {
    path: '/user/dashboard',
    component: DashboardUser
  },
  {
    path: '/user/order',
    component: Order
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router