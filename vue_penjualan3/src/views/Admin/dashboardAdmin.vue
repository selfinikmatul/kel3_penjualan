<template>
  <div class="page">

    <!-- NAVBAR -->
    <div class="navbar">

      <div>
        <h2>🛍 MINI SPW</h2>
        <p>Admin Panel</p>
      </div>

      <button
        class="logout-btn"
        @click="logout"
      >
        Logout
      </button>

    </div>

    <!-- HERO -->
    <div class="hero-card">

      <h1>👋 Selamat Datang, Admin</h1>

      <p>
        Kelola produk dan pesanan MINI SPW
        dengan lebih mudah
      </p>

    </div>

    <!-- MENU -->
    <div class="grid">

      <!-- PRODUK -->
      <div
        class="card"
        @click="go('/admin/produk')"
      >

        <div class="icon">
          📦
        </div>

        <h3>Kelola Produk</h3>

        <p>
          Tambah, edit dan hapus produk
        </p>

      </div>

      <!-- PESANAN -->
      <div
        class="card"
        @click="go('/admin/pesanan')"
      >

        <div class="icon">
          🧾
        </div>

        <h3>Kelola Pesanan</h3>

        <p>
          Lihat dan verifikasi pesanan
        </p>

      </div>

    </div>

  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const go = (path) => {
  router.push(path)
}

const logout = () => {
  localStorage.clear()
  router.push('/login')
}
</script>

<style scoped>

.page{
  min-height:100vh;
  background:#f5f7fb;
  padding:30px;
  font-family:Arial;
}

/* NAVBAR */

.navbar{
  background:white;
  padding:20px 25px;
  border-radius:20px;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:25px;
}

.navbar h2{
  color:#4338ca;
  margin-bottom:4px;
}

.navbar p{
  color:#777;
  font-size:14px;
}

/* LOGOUT */

.logout-btn{
  background:#ef4444;
  color:white;
  border:none;
  padding:12px 18px;
  border-radius:12px;
  cursor:pointer;
}

.logout-btn:hover{
  background:#dc2626;
}

/* HERO */

.hero-card{
  background:linear-gradient(
    135deg,
    #4338ca,
    #6366f1
  );
  color:white;
  border-radius:25px;
  padding:40px;
  margin-bottom:30px;
  box-shadow:0 10px 20px rgba(67,56,202,.2);
}

.hero-card h1{
  margin-bottom:10px;
  font-size:35px;
}

.hero-card p{
  opacity:.9;
  font-size:16px;
}

/* GRID */

.grid{
  display:grid;
  grid-template-columns:
    repeat(auto-fit,minmax(260px,1fr));
  gap:25px;
}

/* CARD */

.card{
  background:white;
  border-radius:25px;
  padding:30px;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
  cursor:pointer;
  transition:.3s;
  text-align:center;
}

.card:hover{
  transform:translateY(-8px);
}

.icon{
  font-size:45px;
  margin-bottom:15px;
}

.card h3{
  color:#4338ca;
  margin-bottom:10px;
}

.card p{
  color:#777;
}

</style>
