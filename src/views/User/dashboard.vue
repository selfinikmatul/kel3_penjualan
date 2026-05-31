<template>
  <div class="container">

    <h1 class="title">🛒 Toko Perlengkapan Sekolah</h1>

    <!-- PRODUK -->
    <div class="product-container">

      <div
        class="card"
        v-for="item in products"
        :key="item.id"
      >

        <h2>{{ item.name }}</h2>

        <p class="price">
          Rp {{ item.price.toLocaleString() }}
        </p>

        <button @click="buyItem(item)">
          Beli
        </button>

      </div>

    </div>

    <!-- PESAN -->
    <div class="nota">

      <h2>📋 Pesanan</h2>

      <div v-if="cart.length === 0" class="empty">
        Belum ada barang dipilih
      </div>

      <div
        class="nota-item"
        v-for="(item, index) in cart"
        :key="index"
      >
        <span>{{ item.name }}</span>
        <span>Rp {{ item.price.toLocaleString() }}</span>
      </div>

      <hr>

      <h3 class="total">
        Total : Rp {{ totalPrice.toLocaleString() }}
      </h3>

      <button
        class="finish-btn"
        v-if="cart.length > 0"
        @click="buatPesanan"
      >
        Pesan
      </button>

    </div>

    <!-- NOTA QR -->
    <div
      class="qr-box"
      v-if="showQR"
    >

      <h2>✅ Pesanan Berhasil</h2>

      <p>
        Tunjukkan QR ini saat mengambil barang
      </p>

      <!-- QR -->
      <img
        :src="qrCode"
        alt="QR Code"
      >

      <h3>Kode Pesanan</h3>

      <h1>{{ orderCode }}</h1>

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

const showQR = ref(false)

const orderCode = ref('')

const qrCode = ref('')

const buyItem = (item) => {
  cart.value.push(item)
}

const totalPrice = computed(() => {
  return cart.value.reduce((total, item) => {
    return total + item.price
  }, 0)
})

const buatPesanan = () => {

  // RANDOM CODE
  const randomCode =
    'ORD-' +
    Math.floor(Math.random() * 999999)

  orderCode.value = randomCode

  // QR GENERATOR
  qrCode.value =
    `https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=${randomCode}`

  showQR.value = true

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
  margin-bottom: 15px;
}

.price{
  color: #4338ca;
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 20px;
}

button{
  background: #4338ca;
  color: white;
  border: none;
  padding: 10px 18px;
  border-radius: 10px;
  cursor: pointer;
}

button:hover{
  background: #312e81;
}

/* PESAN */

.nota{
  margin-top: 45px;
  background: white;
  padding: 25px;
  border-radius: 20px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

.nota h2{
  margin-bottom: 20px;
}

.empty{
  color: gray;
}

.nota-item{
  display: flex;
  justify-content: space-between;
  margin: 12px 0;
}

hr{
  margin: 20px 0;
}

.total{
  text-align: right;
  color: #4338ca;
  margin-bottom: 20px;
}

.finish-btn{
  width: 100%;
  background: #16a34a;
}

.finish-btn:hover{
  background: #15803d;
}

/* QR */

.qr-box{
  margin-top: 40px;
  background: white;
  padding: 30px;
  border-radius: 20px;
  text-align: center;
  box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

.qr-box h2{
  color: #16a34a;
  margin-bottom: 10px;
}

.qr-box p{
  margin-bottom: 20px;
  color: #555;
}

.qr-box img{
  width: 220px;
  margin: 20px 0;
}

.qr-box h1{
  color: #4338ca;
  margin-top: 10px;
}

</style>
