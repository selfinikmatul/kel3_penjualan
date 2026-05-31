<template>
  <div class="page">

    <!-- HEADER -->
    <div class="header-card">
      <div>
        <h2>📋 Kelola Pesanan</h2>
        <p>Data pesanan pelanggan MINI SPW</p>
      </div>

      <button
        class="scan-btn"
        @click="toggleScanner"
      >
        {{ showScanner ? '❌ Tutup Scan' : '📷 Scan QR' }}
      </button>
    </div>

    <!-- SCANNER -->
    <div
      v-if="showScanner"
      class="scanner-card"
    >
      <div id="reader"></div>
    </div>

    <!-- TABEL PESANAN -->
    <div class="table-card">

      <table>
        <thead>
          <tr>
            <th>Kode</th>
            <th>Barang</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>

          <tr
            v-for="item in daftarPesanan"
            :key="item.id"
          >
            <td>{{ item.kode_pesanan }}</td>

            <td>
              {{ item.barang?.nama_barang }}
            </td>

            <td>
              Rp
              {{ Number(item.total_harga).toLocaleString() }}
            </td>

            <td>

              <span
                v-if="item.status==='Menunggu Scan'"
                class="badge waiting"
              >
                Menunggu Scan
              </span>

              <span
                v-else
                class="badge success"
              >
                Sudah Diambil
              </span>

            </td>

          </tr>

        </tbody>
      </table>

    </div>

    <!-- DETAIL HASIL SCAN -->
    <div
      v-if="pesanan.length"
      class="detail-card"
    >

      <h3>✅ Pesanan Ditemukan</h3>

      <div
        v-for="item in pesanan"
        :key="item.id"
        class="scan-item"
      >

        <p>
          <b>Barang :</b>
          {{ item.barang?.nama_barang }}
        </p>

        <p>
          <b>Harga :</b>
          Rp
          {{ Number(item.total_harga).toLocaleString() }}
        </p>

        <hr>

      </div>

      <h4>
        Kode:
        {{ pesanan[0].kode_pesanan }}
      </h4>

      <h4>
        Status:
        {{ pesanan[0].status }}
      </h4>

      <button
        v-if="pesanan[0].status !== 'Sudah Diambil'"
        class="verify-btn"
        @click="verifikasi"
      >
        ✔ Verifikasi Semua Pesanan
      </button>

    </div>

  </div>
</template>

<script setup>
import {
  ref,
  onMounted
} from 'vue'

import axios from 'axios'
import { Html5QrcodeScanner }
from 'html5-qrcode'

const daftarPesanan = ref([])
const pesanan = ref([])
const showScanner = ref(false)
const scanner = ref(null)

/* AMBIL PESANAN */

const getPesanan = async () => {

  try {

    const res = await axios.get(
      'http://127.0.0.1:8000/api/transaksi'
    )

    daftarPesanan.value = res.data

  } catch(err){

    console.log(err)

  }
}

onMounted(()=>{
  getPesanan()
})

/* SCAN */

const toggleScanner = () => {

  if(!showScanner.value){

    showScanner.value = true

    setTimeout(()=>{

      scanner.value =
        new Html5QrcodeScanner(
          "reader",
          {
            fps:10,
            qrbox:250
          },
          false
        )

      scanner.value.render(

        async(decodedText)=>{

          try{

            const res =
              await axios.get(
                `http://127.0.0.1:8000/api/scan/${decodedText}`
              )

            console.log(res.data)

            if(res.data.length){

              pesanan.value =
                res.data

              scanner.value.clear()
              showScanner.value = false

            }else{

              alert('Pesanan tidak ditemukan')

            }

          }catch(err){

            console.log(err)
            alert('Scan gagal')

          }

        },
        ()=>{}
      )

    },300)

  }else{

    showScanner.value = false

    if(scanner.value){
      scanner.value.clear()
    }
  }
}

/* VERIFIKASI */

const verifikasi = async () => {

  try{

    for(const item of pesanan.value){

      await axios.put(
        `http://127.0.0.1:8000/api/transaksi/${item.id}`,
        {
          status:'Sudah Diambil'
        }
      )
    }

    alert('Semua pesanan diverifikasi')

    pesanan.value = []

    getPesanan()

  }catch(err){

    console.log(err)

  }
}
</script>

<style scoped>

.page{
  min-height:100vh;
  background:#f5f7fb;
  padding:30px;
  font-family:Arial;
}

.header-card{
  background:white;
  border-radius:20px;
  padding:25px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:25px;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
}

.header-card h2{
  color:#4338ca;
}

.scan-btn{
  background:#4338ca;
  color:white;
  border:none;
  padding:12px 18px;
  border-radius:12px;
  cursor:pointer;
}

.scanner-card{
  background:white;
  padding:20px;
  border-radius:20px;
  margin-bottom:25px;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
}

.table-card{
  background:white;
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
}

table{
  width:100%;
  border-collapse:collapse;
}

thead{
  background:#4338ca;
  color:white;
}

th,td{
  padding:16px;
  text-align:center;
}

tbody tr{
  border-bottom:1px solid #eee;
}

.badge{
  padding:8px 12px;
  border-radius:999px;
  color:white;
}

.waiting{
  background:#f59e0b;
}

.success{
  background:#10b981;
}

.detail-card{
  margin-top:25px;
  background:white;
  border-radius:20px;
  padding:25px;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
}

.scan-item{
  margin:15px 0;
}

.verify-btn{
  width:100%;
  background:#10b981;
  color:white;
  border:none;
  padding:14px;
  border-radius:12px;
  cursor:pointer;
  margin-top:15px;
}

</style>
