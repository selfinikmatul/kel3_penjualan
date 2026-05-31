<template>
  <div class="login-page">

    <!-- BACKGROUND TEXT -->
    <div class="bg-text">MINI SPW</div>

    <!-- LOGO SMK (SAFE: pakai fallback emoji dulu) -->
    <div class="logo logo-smk">🏫 SMK Tunas Harapan Pati</div>

    <!-- DECOR ICONS (PAKAI EMOJI BIAR AMAN) -->
    <div class="icon i1">🛍️</div>
    <div class="icon i2">👕</div>
    <div class="icon i3">📦</div>

    <!-- LOGIN BOX -->
    <div class="login-box shadow p-4 animate-form">

      <h3 class="text-center mb-3">MINI SPW</h3>
      <p class="text-center text-muted small">
        SMK Tunas Harapan Pati
      </p>

      <div class="mb-3">
        <label>Email</label>
        <input type="email" v-model="email" class="form-control" />
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input type="password" v-model="password" class="form-control" />
      </div>

      <button class="btn btn-primary w-100" @click="login">
        Login
      </button>

      <p v-if="error" class="text-danger text-center mt-2">
        {{ error }}
      </p>

    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import api from '../api/api'
import { useRouter } from 'vue-router'

const router = useRouter()

const email = ref('')
const password = ref('')
const error = ref('')

const login = async () => {
  try {
    const response = await api.post('/login', {
      email: email.value,
      password: password.value
    })

    localStorage.setItem('token', response.data.token)
    localStorage.setItem('user', JSON.stringify(response.data.user))

    const emailUser = response.data.user.email?.trim().toLowerCase()

    if (emailUser === 'admin1@gmail.com') {
      router.replace('/admin/dashboard')
    } else {
      router.replace('/user/dashboard')
    }

  } catch (err) {
    error.value = 'Login gagal'
  }
}
</script>

<style scoped>

/* BACKGROUND */
.login-page {
  min-height: 100vh;
  background: linear-gradient(135deg, #e3f2fd, #ffffff);
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  overflow: hidden;
}

/* TEXT */
.bg-text {
  position: absolute;
  font-size: 90px;
  font-weight: bold;
  color: rgba(0,0,0,0.05);
  user-select: none;
}

/* LOGO TEXT SMK */
.logo-smk {
  position: absolute;
  top: 20px;
  left: 20px;
  font-size: 14px;
  opacity: 0.6;
}

/* ICON DECOR */
.icon {
  position: absolute;
  font-size: 40px;
  opacity: 0.3;
}

.i1 { top: 120px; left: 50px; }
.i2 { bottom: 120px; left: 80px; }
.i3 { top: 100px; right: 60px; }

/* LOGIN BOX */
.login-box {
  width: 100%;
  max-width: 380px;
  border-radius: 16px;
  background: white;
  z-index: 2;
  position: relative;
}

/* ANIMASI */
.animate-form {
  animation: fadeSlide 0.6s ease;
}

@keyframes fadeSlide {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

</style>