<template>
  <div class="container">

    <h1 class="title">📦 Kelola Produk</h1>

    <!-- FORM -->
    <div class="form-box">

      <input
        type="text"
        v-model="nama_barang"
        placeholder="Nama Barang"
      >

      <input
        type="number"
        v-model="harga_barang"
        placeholder="Harga Barang"
      >

      <input
        type="number"
        v-model="stok_barang"
        placeholder="Stok Barang"
      >

      <button @click="tambahBarang">
        Tambah Produk
      </button>

    </div>

    <!-- PRODUK -->
    <div class="product-container">

      <div
        class="card"
        v-for="item in barang"
        :key="item.id"
      >

        <h2>{{ item.nama_barang }}</h2>

        <p class="harga">
          Rp {{ item.harga_barang }}
        </p>

        <p class="stok">
          Stok : {{ item.stok_barang }}
        </p>

        <button
          class="hapus"
          @click="hapusBarang(item.id)"
        >
          Hapus
        </button>

      </div>

    </div>

  </div>
</template>

<script setup>

import { ref } from 'vue'

const nama_barang = ref('')
const harga_barang = ref('')
const stok_barang = ref('')

const barang = ref([
  {
    id: 1,
    nama_barang: 'Spidol',
    harga_barang: 5000,
    stok_barang: 10
  },
  {
    id: 2,
    nama_barang: 'Bolpoin',
    harga_barang: 3000,
    stok_barang: 20
  },
  {
    id: 3,
    nama_barang: 'Pensil',
    harga_barang: 2000,
    stok_barang: 15
  }
])

const tambahBarang = () => {

  if(
    nama_barang.value === '' ||
    harga_barang.value === '' ||
    stok_barang.value === ''
  ){
    alert('Isi semua data!')
    return
  }

  barang.value.push({
    id: Date.now(),
    nama_barang: nama_barang.value,
    harga_barang: harga_barang.value,
    stok_barang: stok_barang.value
  })

  nama_barang.value = ''
  harga_barang.value = ''
  stok_barang.value = ''

}

const hapusBarang = (id) => {
  barang.value = barang.value.filter(
    item => item.id !== id
  )
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
  background: #f5f7fb;
  padding: 30px;
  font-family: Arial, Helvetica, sans-serif;
}

.title{
  text-align: center;
  margin-bottom: 35px;
  color: #4338ca;
}

/* FORM */

.form-box{
  background: white;
  padding: 25px;
  border-radius: 20px;
  margin-bottom: 35px;
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
  box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

.form-box input{
  flex: 1;
  min-width: 200px;
  padding: 12px;
  border-radius: 10px;
  border: 1px solid #ccc;
  font-size: 15px;
}

.form-box button{
  background: #4338ca;
  color: white;
  border: none;
  padding: 12px 18px;
  border-radius: 10px;
  cursor: pointer;
}

.form-box button:hover{
  background: #312e81;
}

/* CARD */

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
}

.card h2{
  margin-bottom: 15px;
  color: #333;
}

.harga{
  color: #4338ca;
  font-weight: bold;
  margin-bottom: 10px;
}

.stok{
  color: #16a34a;
  margin-bottom: 20px;
}

.hapus{
  background: crimson;
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 10px;
  cursor: pointer;
}

.hapus:hover{
  background: darkred;
}

</style>
