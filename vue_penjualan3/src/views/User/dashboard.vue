<template>
  <div class="container">

    <h1 class="title">🛒 Toko Perlengkapan Sekolah</h1>

    <!-- PRODUK -->
    <div class="product-container">

      <div class="card" v-for="item in products" :key="item.id">

        <h2>{{ item.name }}</h2>

        <p class="price">
          Rp {{ item.price.toLocaleString() }}
        </p>

        <button @click="buyItem(item)">
          Beli
        </button>

      </div>

    </div>

    <!-- NOTA -->
    <div class="nota">

      <h2>🧾 Nota Pembelian</h2>

      <div v-if="cart.length === 0" class="empty">
        Belum ada barang dibeli
      </div>

      <div
        v-for="(item, index) in cart"
        :key="index"
        class="nota-item"
      >
        <span>{{ item.name }}</span>
        <span>Rp {{ item.price.toLocaleString() }}</span>
      </div>

      <hr>

      <h3 class="total">
        Total : Rp {{ totalPrice.toLocaleString() }}
      </h3>

      <!-- TOMBOL SELESAI -->
      <button
        class="finish-btn"
        v-if="cart.length > 0"
        @click="finishOrder"
      >
        Selesai
      </button>

    </div>

    <!-- KELOLA PESANAN -->
    <div class="orders">

      <h2>📦 Kelola Pesanan</h2>

      <div v-if="orders.length === 0" class="empty">
        Belum ada pesanan selesai
      </div>

      <div
        class="order-card"
        v-for="(order, index) in orders"
        :key="index"
      >

        <h3>Pesanan {{ index + 1 }}</h3>

        <div
          v-for="(item, i) in order.items"
          :key="i"
          class="order-item"
        >
          <span>{{ item.name }}</span>
          <span>Rp {{ item.price.toLocaleString() }}</span>
        </div>

        <hr>

        <h4>
          Total : Rp {{ order.total.toLocaleString() }}
        </h4>

      </div>

    </div>

  </div>
</template>

<script setup>

import { ref, computed } from 'vue'

const products = ref([
  { id: 1, name: 'Spidol', price: 5000 },
  { id: 2, name: 'Topi Sekolah', price: 25000 },
  { id: 3, name: 'Dasi', price: 15000 },
  { id: 4, name: 'Bolpoin', price: 3000 },
  { id: 5, name: 'Ikat Pinggang', price: 20000 },
  { id: 6, name: 'Kaos Kaki', price: 10000 },
  { id: 7, name: 'Kerudung', price: 35000 },
  { id: 8, name: 'Pensil', price: 2000 }
])

const cart = ref([])

const orders = ref([])

const buyItem = (item) => {
  cart.value.push(item)
}

const totalPrice = computed(() => {
  return cart.value.reduce((total, item) => {
    return total + item.price
  }, 0)
})

const finishOrder = () => {

  orders.value.push({
    items: [...cart.value],
    total: totalPrice.value
  })

  cart.value = []
}

</script>

<style scoped>

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.container{
  min-height: 100vh;
  padding: 30px;
  background: #f5f7fb;
  font-family: Arial, Helvetica, sans-serif;
}

/* JUDUL */

.title{
  text-align: center;
  margin-bottom: 40px;
  color: #4338ca;
  font-size: 38px;
}

/* PRODUK */

.product-container{
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
  gap: 25px;
}

.card{
  background: white;
  padding: 25px;
  border-radius: 20px;
  text-align: center;
  box-shadow: 0 6px 15px rgba(0,0,0,0.1);
  transition: 0.3s;
}

.card:hover{
  transform: translateY(-8px);
}

.card h2{
  color: #333;
  margin-bottom: 15px;
}

.price{
  color: #4f46e5;
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 18px;
}

button{
  background: #4f46e5;
  color: white;
  border: none;
  padding: 10px 18px;
  border-radius: 10px;
  cursor: pointer;
  transition: 0.3s;
  font-size: 15px;
}

button:hover{
  background: #372fcf;
}

/* NOTA */

.nota{
  margin-top: 45px;
  background: white;
  padding: 25px;
  border-radius: 20px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

.nota h2{
  margin-bottom: 20px;
  color: #333;
}

.empty{
  color: gray;
}

.nota-item{
  display: flex;
  justify-content: space-between;
  margin: 12px 0;
  font-size: 17px;
}

hr{
  margin: 20px 0;
}

.total{
  text-align: right;
  color: #4f46e5;
  margin-bottom: 20px;
}

.finish-btn{
  width: 100%;
  background: #16a34a;
}

.finish-btn:hover{
  background: #15803d;
}

/* KELOLA PESANAN */

.orders{
  margin-top: 40px;
  background: white;
  padding: 25px;
  border-radius: 20px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

.orders h2{
  margin-bottom: 20px;
}

.order-card{
  margin-top: 20px;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 15px;
}

.order-card h3{
  margin-bottom: 15px;
  color: #4338ca;
}

.order-item{
  display: flex;
  justify-content: space-between;
  margin: 10px 0;
}

.order-card h4{
  text-align: right;
  color: #16a34a;
}

</style>
