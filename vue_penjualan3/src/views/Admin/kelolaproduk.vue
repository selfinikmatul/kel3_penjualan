<template>
  <div class="page">

    <!-- HEADER -->
    <div class="header-card">

      <div>
        <h2>📦 Kelola Produk</h2>
        <p>Tambah, edit, dan hapus produk MINI SPW</p>
      </div>

    </div>

    <!-- FORM -->
    <div class="form-card">

      <h4 class="mb-3">
        {{ editMode ? '✏️ Edit Produk' : '➕ Tambah Produk' }}
      </h4>

      <input
        v-model="form.nama_barang"
        class="input"
        placeholder="Nama Barang"
      />

      <input
        v-model="form.kategori"
        class="input"
        placeholder="Kategori"
      />

      <input
        v-model="form.harga"
        type="number"
        class="input"
        placeholder="Harga"
      />

      <input
        v-model="form.stok"
        type="number"
        class="input"
        placeholder="Stok"
      />

      <button
        class="save-btn"
        @click="saveProduk"
      >
        {{ editMode ? 'Update Produk' : 'Simpan Produk' }}
      </button>

    </div>

    <!-- TABLE -->
    <div class="table-card">

      <table>

        <thead>
          <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>

          <tr
            v-for="item in produk"
            :key="item.id"
          >
            <td>{{ item.nama_barang }}</td>
            <td>{{ item.kategori }}</td>
            <td>
              Rp {{ Number(item.harga).toLocaleString() }}
            </td>
            <td>{{ item.stok }}</td>

            <td>

              <button
                class="edit-btn"
                @click="editProduk(item)"
              >
                Edit
              </button>

              <button
                class="delete-btn"
                @click="hapusProduk(item.id)"
              >
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
import { ref, onMounted } from 'vue'
import axios from 'axios'

const produk = ref([])

const editMode = ref(false)
const editId = ref(null)

const form = ref({
  nama_barang:'',
  kategori:'',
  harga:'',
  stok:''
})

const getProduk = async () => {
  const res = await axios.get(
    'http://127.0.0.1:8000/api/barang'
  )
  produk.value = res.data
}

onMounted(() => {
  getProduk()
})

const saveProduk = async () => {

  if(editMode.value){

    await axios.put(
      `http://127.0.0.1:8000/api/barang/${editId.value}`,
      form.value
    )

  }else{

    await axios.post(
      'http://127.0.0.1:8000/api/barang',
      form.value
    )
  }

  form.value = {
    nama_barang:'',
    kategori:'',
    harga:'',
    stok:''
  }

  editMode.value = false
  editId.value = null

  getProduk()
}

const editProduk = (item) => {

  editMode.value = true
  editId.value = item.id

  form.value = {
    nama_barang:item.nama_barang,
    kategori:item.kategori,
    harga:item.harga,
    stok:item.stok
  }
}

const hapusProduk = async(id)=>{

  if(confirm('Hapus produk?')){

    await axios.delete(
      `http://127.0.0.1:8000/api/barang/${id}`
    )

    getProduk()
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

/* HEADER */

.header-card{
  background:white;
  border-radius:20px;
  padding:25px;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
  margin-bottom:25px;
}

.header-card h2{
  color:#4338ca;
  margin-bottom:5px;
}

.header-card p{
  color:#777;
}

/* FORM */

.form-card{
  background:white;
  padding:25px;
  border-radius:20px;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
  margin-bottom:25px;
}

.input{
  width:100%;
  padding:14px;
  border:1px solid #ddd;
  border-radius:12px;
  margin-bottom:15px;
  outline:none;
}

.input:focus{
  border-color:#4338ca;
}

.save-btn{
  background:#4338ca;
  color:white;
  border:none;
  padding:12px 18px;
  border-radius:12px;
  cursor:pointer;
  width:100%;
}

.save-btn:hover{
  background:#312e81;
}

/* TABLE */

.table-card{
  background:white;
  border-radius:20px;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
  overflow:hidden;
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

tbody tr:hover{
  background:#f8f9ff;
}

.edit-btn{
  background:#f59e0b;
  color:white;
  border:none;
  padding:8px 14px;
  border-radius:10px;
  margin-right:8px;
}

.delete-btn{
  background:#ef4444;
  color:white;
  border:none;
  padding:8px 14px;
  border-radius:10px;
}

button{
  cursor:pointer;
}

</style>
