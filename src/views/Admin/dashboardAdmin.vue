<template>
  <div class="page">

    <!-- NAVBAR -->
    <div class="navbar">
      <h2>Admin Dashboard</h2>
      <button @click="logout">Logout</button>
    </div>

    <!-- CONTENT -->
    <div class="content">

      <h1>👋 Selamat Datang, Admin</h1>
      <p class="sub">Kelola sistem penjualan dengan mudah</p>

      <!-- MENU CARDS -->
      <div class="grid">

        <div class="card" @click="go('/admin/produk')">
          <h3>📦 Kelola Produk</h3>
          <p>Tambah, edit, hapus produk</p>
        </div>

        <div class="card" @click="go('/admin/pesanan')">
          <h3>🧾 Kelola Pesanan</h3>
          <p>Kelola semua pesanan pelanggan</p>
        </div>

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
.page {
  font-family: sans-serif;
  background: #f4f6f9;
  min-height: 100vh;
}

/* NAVBAR */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #2c3e50;
  color: white;
  padding: 15px 25px;
}

.navbar button {
  padding: 8px 12px;
  border: none;
  background: #e74c3c;
  color: white;
  border-radius: 6px;
  cursor: pointer;
}

/* CONTENT */
.content {
  padding: 30px;
}

.sub {
  color: gray;
  margin-bottom: 20px;
}

/* GRID CARD */
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

/* CARD */
.card {
  background: white;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  cursor: pointer;
  transition: 0.2s;
}

.card:hover {
  transform: translateY(-5px);
}

.card h3 {
  margin-bottom: 10px;
}
</style>