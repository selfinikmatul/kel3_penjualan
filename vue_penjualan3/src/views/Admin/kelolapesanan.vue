<template>
  <div class="container">

    <div class="header">
      <h1>Kelola Pesanan</h1>

    </div>

    <div class="card">
      <table>
        <thead>
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
          <tr v-for="(item, index) in pesananList" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ item.nama }}</td>
            <td>{{ item.produk }}</td>

            <td>
              <span
                :class="
                  item.status == 'Diproses'
                    ? 'status proses'
                    : 'status selesai'
                "
              >
                {{ item.status }}
              </span>
            </td>

            <td>Rp {{ item.total }}</td>

            <td>
              <button class="btn selesai" @click="ubahStatus(index)">
                Selesai
              </button>

              <button class="btn hapus" @click="hapus(index)">
                Hapus
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue'

const pesananList = ref([
  {
    nama: 'Slamikk',
    produk: 'Sempik',
    status: 'Diproses',
    total: '12.000'
  }
])

const ubahStatus = (index) => {
  pesananList.value[index].status = 'Selesai'
}

const hapus = (index) => {
  pesananList.value.splice(index, 1)
}

const tambahPesanan = () => {
  pesananList.value.push({
    nama: 'Customer Baru',
    produk: 'Produk Baru',
    status: 'Diproses',
    total: '100.000'
  })
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
  padding: 40px;
  background: #f4f7fb;
  font-family: Arial, Helvetica, sans-serif;
}

.header{
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
}

.header h1{
  font-size: 35px;
  color: #333;
}

.btn-tambah{
  background: #4f46e5;
  color: white;
  border: none;
  padding: 12px 20px;
  border-radius: 10px;
  cursor: pointer;
  font-size: 15px;
  transition: 0.3s;
}

.btn-tambah:hover{
  background: #4338ca;
}

.card{
  background: white;
  padding: 25px;
  border-radius: 20px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

table{
  width: 100%;
  border-collapse: collapse;
}

th{
  background: #4f46e5;
  color: white;
  padding: 15px;
  text-align: left;
}

td{
  padding: 15px;
  border-bottom: 1px solid #eee;
}

tr:hover{
  background: #f9fafb;
}

.status{
  padding: 8px 14px;
  border-radius: 20px;
  font-size: 13px;
  color: white;
}

.proses{
  background: orange;
}

.selesai{
  background: #22c55e;
}

.btn{
  border: none;
  padding: 8px 12px;
  border-radius: 8px;
  color: white;
  cursor: pointer;
  margin-right: 5px;
}

.hapus{
  background: #ef4444;
}

.hapus:hover{
  background: #dc2626;
}

</style>
