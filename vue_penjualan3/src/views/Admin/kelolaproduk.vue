<template>
  <div>
    <h1>Data Produk</h1>

    <ul>
      <li v-for="item in barang" :key="item.id">
        {{ item.nama_barang }}
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../api/api'

const barang = ref([])

onMounted(async () => {
    const response = await api.get('/barang')
    barang.value = response.data
})
</script>