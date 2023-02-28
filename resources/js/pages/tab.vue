<script setup>
const isDialogVisible = ref(false)
const first_name = ref('')
const last_name = ref('')
const phone = ref('')
const email = ref('')
const password = ref('')
const role = ref()
const interest = ref([])
</script>

<template>
  <VDialog
    v-model="isDialogVisible"
    max-width="600"
  >
    <!-- Dialog Activator -->
    <template #activator="{ props }">
      <VBtn
        v-bind="props"
        style="left: 87%"
      >
        Add User
      </VBtn>
    </template>


    <DialogCloseBtn @click="isDialogVisible = !isDialogVisible" />

    <!-- Dialog Content -->
    <VCard title="User Profile">
      <VCardText>
        <VForm @submit.prevent="AddUser">
        <VRow>
          <VCol
            cols="12"
            sm="6"
            md="6"
          >
            <VTextField
              v-model="first_name"
              label="First Name"
            />
          </VCol>
          <VCol
            cols="12"
            sm="6"
            md="6"
          >
            <VTextField
              v-model="last_name"
              label="last Name"
            />
          </VCol>
          <VCol
            cols="12"
            sm="8"
            md="8"
          >
            <VTextField
              v-model="phone"
              type="number"
              label="phone"
              persistent-hint
            />
          </VCol>
          <VCol
            cols="12"
            sm="4"
          >
            <VSelect
              v-model="role"
              :items="['user', 'owner']"
              label="role"
            />
          </VCol>
          <VCol cols="12">
            <VTextField
              v-model="email"
              label="Email"
            />
          </VCol>
          <VCol cols="12">
            <VTextField
              v-model="password"
              label="Password"
              type="password"
            />
          </VCol>
        </VRow>
        </VForm>
      </VCardText>

      <VCardText class="d-flex justify-end flex-wrap gap-3">
        <VBtn
          variant="tonal"
          color="secondary"
          @click="isDialogVisible = false"
        >
          Close
        </VBtn>
        <VBtn type="submit">
          Save
        </VBtn>
      </VCardText>
    </VCard>
  </VDialog>
  <table
    id="myTable"
    class="table table-bordered mt-5"
  >
    <thead>
      <tr>
        <th class="thead">
          ID
        </th>
        <th class="thead">
          name
        </th>
        <th class="thead">
          mail
        </th>
        <th class="thead">
          phone
        </th>
        <th class="thead">
          role
        </th>
        <th class="thead">
          actions
        </th>
      </tr>
    </thead>
    <tbody />
  </table>
  <VTable />
  <VTable />
</template>

<script>
import axios from "axios"
import DataTables from "datatables.net"
import DataTablesLib from "datatables.net-bs5"
import Button from "datatables.net-buttons/js/buttons.html5"
import print from "datatables.net-buttons/js/buttons.print"
import pdfFonts from "pdfmake/build/vfs_fonts"
import "pdfmake"
import "datatables.net-responsive-bs5"
import JsZip from "jszip"

window.JsZip = "jszip"


import "bootstrap/dist/css/bootstrap.min.css"
import "datatables.net-bs4"
import "datatables.net-bs4/css/dataTables.bootstrap4.min.css"
import "datatables.net-buttons-bs4"
import "datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
import "datatables.net-buttons/js/buttons.colVis"
import "datatables.net-buttons/js/buttons.flash"
import $ from "jquery"
import router from "@/router"

let DataTable
export default{


  // eslint-disable-next-line vue/component-api-style
  mounted() {
    this.getUsers()
  },
  // eslint-disable-next-line vue/component-api-style
  methods: {
    getUsers() {

      axios
        .get("http://127.0.0.1:8000/api/users")
        .then(response => {
          $("#myTable").DataTable({
            data: response.data,
            responsive:true,
            "dom": '<lf<Brt><t>ip>',
            buttons: ["csv","print","copy","colvis"],
            columns: [
              { data: "id" },
              { data: "firstname" },
              { data: "email" },
              { data: "phonenumber" },
              { data: "role",
                render:function (data,type,row){
                  let btn=''
                  if (data === "user"){
                    btn += '<button class="btn btn-info">'+ data +'</button>'
                  }else {
                    btn += '<button class="btn btn-primary">'+ data +'</button>'
                  }

                  return btn
                },
              },
              { data: null,
                render:function (data,type,row){
                  let btn=''
                  btn += '<button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>'+' '+ '<button class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>'

                  return btn
                },
              },

            ],
          })
        })
        .catch(error => console.log(error.response))
    },

    AddUser() {

      axios.post('http://127.0.0.1:8000/api/user-register', data)
        .then(
          res => {
            if (res.status === 200){
              localStorage.setItem('key-info',JSON.stringify(res.data))
              console.log(res)
              console.log(JSON.stringify((res.data)))
              router.push("/")
            }
          },
        ).catch(
          err => {
            console.log(err)
          },
        )
    },

  },

}
</script>

<style lang="scss">
table {
  width: 800px;
  border-collapse: collapse;
  box-shadow: 0 2px 5px   rgba(0,0,0);
  background: linear-gradient(0deg, #ffffff, floralwhite);
  border-radius: 10px;
  margin: 1%;
  table-border-color: #ffffff;
  padding: 1%;
  text-align: center;
}

th,td {
  padding: 15px;
  background-color: rgba(255,255,255,0.2);
  color: black;
}


thead {
  th {
    background-color: #55608f;
    text-align: center;
  }
}

tbody {
  tr {
    &:hover {
      background-color: rgba(255,255,255,0.3);
    }
  }
}
div.dataTables_wrapper div.dataTables_filter {
  text-align: right;
  margin: 1%;
}
.btn-group>.btn-group:not(:last-child)>.btn, .btn-group>.btn.dropdown-toggle-split:first-child, .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  position : relative ;
  z-index : 0 ;
  width :90px ;
  height : 40px ;
  text-decoration : none ;
  font-weight : bold ;
  color : var(--line_color) ;
  letter-spacing : 2px ;
  transition : all .3s ease ;
  background: white;
  border: none;
  box-shadow: 0 0 5px   rgba(0,0,0);
}
.btn-group>.btn-group:not(:first-child)>.btn, .btn-group>.btn:nth-child(n+3), .btn-group>:not(.btn-check)+.btn {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  position : relative ;
  z-index : 0 ;
  width :90px ;
  height : 40px ;
  text-decoration : none ;
  font-weight : bold ;
  color : var(--line_color) ;
  letter-spacing : 2px ;
  transition : all .3s ease ;
  background: white;
  border: none;
  box-shadow: 0 0 5px   rgba(0,0,0);
}
.btn-group > .btn-group:not(:first-child) > .btn, .btn-group > .btn:nth-child(n+3), .btn-group > :not(.btn-check) + .btn {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  position: relative;
  z-index: 0;
  width: 190px;
  height: 40px;
  text-decoration: none;
  font-weight: bold;
  color: var(--line_color);
  letter-spacing: 2px;
  transition: all 0.3s ease;
  background: white;
  border: none;
  box-shadow: 0 0 5px rgb(0 0 0);
}
#myTable_length{
  position: absolute;
  top: 5%;
  }
div.dt-buttons {
  position: relative;
  margin: 0% auto 4%;
  left: 25%;
  top: 35px;
}
div.dataTables_wrapper div.dataTables_filter {
  text-align: right;
}
div.dataTables_wrapper div.dataTables_filter {
  text-align: right;
  position: absolute;
  display: initial;
  left: 80%;
  top: 25px;
}
.dropdown-menu {
  --bs-dropdown-link-active-bg: white;
  --bs-dropdown-link-active-color: black;
}
table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting_asc_disabled, table.dataTable thead>tr>th.sorting_desc_disabled, table.dataTable thead>tr>td.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting_asc_disabled, table.dataTable thead>tr>td.sorting_desc_disabled {
   cursor: pointer;
   position: relative;
   padding-right: 26px;
   text-align: center;
 }
</style>


