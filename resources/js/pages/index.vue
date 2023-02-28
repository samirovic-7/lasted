<template>
  <div id="app" class="container">

    <h1 class="text-center">Activity log</h1>

    <h4>welcome {{ username }}</h4>

    <table id="myTable" class="table table-bordered mt-5">
      <thead>
        <tr>
          <th>ID</th>
          <th>Description</th>
          <th>Date</th>
          <th>Staff</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>


  </div>
</template>

<script>
import "bootstrap/dist/css/bootstrap.min.css"
import "datatables.net-bs4"
import "datatables.net-bs4/css/dataTables.bootstrap4.min.css"
import "jszip"
import "pdfmake"
import "datatables.net-buttons-bs4"
import "datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
import "datatables.net-buttons/js/buttons.colVis"
import "datatables.net-buttons/js/buttons.flash"
import "datatables.net-buttons/js/buttons.html5"
import "datatables.net-buttons/js/buttons.print"
import axios from "axios"
import $ from "jquery"
import router from "@/router"



export default {

  // eslint-disable-next-line vue/component-api-style
  data() {
    return {
      localToken:"",
      status:"",
      username: "",
      info: null,
    }
  },
  // eslint-disable-next-line vue/component-api-style
  mounted() {
    // this.getUsers()


    let user = localStorage.getItem('key-info')

    if (!user){
      router.push("login")
    }else {
      this.username=JSON.parse(user).firstname
    }



  },
  // eslint-disable-next-line vue/component-api-style
  methods: {
    // getUsers() {
    //
    //   axios
    //     .get("http://127.0.0.1:8000/api/activities")
    //     .then(response => {
    //       $("#myTable").DataTable({
    //         dom: "Bfrtip",
    //         buttons: ["excel", "print", "csv"],
    //         data: response.data,
    //         columns: [
    //           { data: "id" },
    //           { data: "description" },
    //           { data: "date" },
    //           { data: "properties.attributes.firstname" },
    //
    //         ],
    //       })
    //     })
    //     .catch(error => console.log(error.response))
    // },

  },
}
</script>








