import { createRouter, createWebHistory } from 'vue-router'

import Login from '../views/Login.vue'

import DashboardAdmin from '../views/Admin/dashboardAdmin.vue'
import KelolaProduk from '../views/Admin/kelolaproduk.vue'
import KelolaPesanan from '../views/Admin/kelolapesanan.vue'

import DashboardUser from '../views/User/dashboard.vue'
import Order from '../views/User/order.vue'

const routes = [
  // buka awal -> login
  {
    path: '/',
    redirect: '/login'
  },

  // LOGIN
  {
    path: '/login',
    component: Login
  },

  // ADMIN (harus login)
  {
    path: '/admin/dashboard',
    component: DashboardAdmin,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/produk',
    component: KelolaProduk,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/pesanan',
    component: KelolaPesanan,
    meta: { requiresAuth: true }
  },

  // USER
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

// CEK LOGIN
router.beforeEach((to, from, next) => {

  const token = localStorage.getItem('token')

  if (to.meta.requiresAuth && !token) {
    next('/login')
  } else {
    next()
  }

})

export default router
