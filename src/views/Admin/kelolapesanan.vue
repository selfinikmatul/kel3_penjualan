<template>
  <div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>🧾 Kelola Pesanan</h3>
    </div>

    <div class="card shadow-sm">
      <div class="card-body p-0">

        <table class="table table-hover mb-0">

          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Customer</th>
              <th>Produk</th>
              <th>Status</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>

            <tr v-for="(item, index) in pesananList" :key="item.id">

              <td>{{ index + 1 }}</td>
              <td>{{ item.nama }}</td>
              <td>{{ item.produk }}</td>

              <td>
                <span
                  class="badge"
                  :class="item.status === 'Diproses' ? 'bg-warning' : 'bg-success'"
                >
                  {{ item.status }}
                </span>
              </td>

              <td>Rp {{ item.total }}</td>

              <td>

                <button
                  class="btn btn-success btn-sm me-2"
                  @click="ubahStatus(item)"
                >
                  Selesai
                </button>

                <button
                  class="btn btn-danger btn-sm"
                  @click="hapus(item.id)"
                >
                  Hapus
                </button>

              </td>

            </tr>

            <tr v-if="pesananList.length === 0">
              <td colspan="6" class="text-center text-muted py-3">
                Belum ada data pesanan
              </td>
            </tr>

          </tbody>

        </table>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../api/api'

const pesananList = ref([])


// 📦 AMBIL DATA PESANAN (FIX SUPER AMAN)
const getPesanan = async () => {
  try {
    const res = await api.get('/pesanan')

    console.log('DATA API:', res.data)

    // 🔥 SUPPORT SEMUA FORMAT API
    pesananList.value =
      res.data?.data ||
      res.data?.pesanan ||
      res.data ||
      []

  } catch (err) {
    console.log('Gagal ambil data:', err)
  }
}


// ✏️ UBAH STATUS PESANAN
const ubahStatus = async (item) => {
  try {
    await api.put(`/pesanan/${item.id}`, {
      status: 'Selesai'
    })

    item.status = 'Selesai'

  } catch (err) {
    console.log('Gagal update:', err)
  }
}


// 🗑️ HAPUS PESANAN
const hapus = async (id) => {
  try {
    await api.delete(`/pesanan/${id}`)

    pesananList.value = pesananList.value.filter(
      (item) => item.id !== id
    )

  } catch (err) {
    console.log('Gagal hapus:', err)
  }
}


// 🚀 AUTO LOAD
onMounted(() => {
  getPesanan()
})
</script>