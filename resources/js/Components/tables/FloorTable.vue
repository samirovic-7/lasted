<template>
  <div style="margin-top: 5%">
    <div style="float: right;width: 45%;display: flex;justify-content: space-between;">
      <VRow justify="">
        <div style="width: 65%;display: flex;justify-content: space-between">
          <VSelect
            label="row"
            :items="['10', '20', '30', '40']"
            variant="solo"
            style="width: 18%;"
          />
          <VSpacer />

          <VTextField
            v-model="search"
            type="text"

            label="Search"
            style="width: 70%;"
          />
        </div>
        <VSpacer />
        <VDialog
          v-model="dialog"
          persistent
          width="1024"
        >
          <template #activator="{ props }">
            <VBtn
              v-bind="props"
            >
              Add Users
            </VBtn>
          </template>
          <VCard>
            <VCardTitle>
              <span class="text-h5">Add New Floor</span>
            </VCardTitle>
            <VCardText>
              <VContainer>
                <VRow>
                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <VTextField
                      v-model="floor_name"
                      label="floor name"
                      persistent-placeholder
                     />
                  </VCol>
                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <VTextField
                      v-model="floor_name_loc"
                      label="اسم الطابق"
                      persistent-placeholder
                    />
                  </VCol>
                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <VTextField
                      v-model="no_of_rooms"
                      label="number of rooms"
                      persistent-placeholder
                      type="number"
                    />
                  </VCol>
                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <VTextField
                      v-model="sort_order"
                      label="sort_order"
                      persistent-placeholder
                      type="number"
                    />
                  </VCol>


                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <VCheckbox
                      v-model="active"
                      :label="`room type active: ${active.toString()}`"
                    />
                  </VCol>
                </VRow>
              </VContainer>
            </VCardText>
            <VCardActions>
              <VSpacer />
              <VBtn
                color="blue-darken-1"
                variant="text"
                @click="dialog = false"
              >
                Close
              </VBtn>
              <VBtn
                color="blue-darken-1"
                variant="text"
                @click="Add"
              >
                Submit
              </VBtn>
            </VCardActions>
          </VCard>
        </VDialog>
      </VRow>
    </div>


    <div style="float: left;width: 14%;display: flex;justify-content: space-between">
      <VBtn
        class="btn"
        @click="exportExecl"
      >
        export
      </VBtn>
      <VBtn
        class="btn"
        @click="Downpdf"
      >
        PDF
      </VBtn>
    </div>

    <br>
    <br>
    <br>

    <VTable style="table-layout: fixed">
      <thead>
      <tr>

        <th
          v-if="$i18n.locale === 'en'"
          class="text-left"
        >
          floor name
        </th>
        <th
          v-else="$i18n.locale === 'ar'"
          class="text-left"
        >
          اسم الطابق
        </th>
        <th class="text-left">
          number of rooms
        </th>
        <th class="text-left">
          Status
        </th>
        <th class="text-left">
          Delete
        </th>
        <th class="text-left">
          Update
        </th>
      </tr>
      </thead>


      <tbody>
      <tr
        v-for="item in filterData"
        :key="item.id"
        style="text-align: left"
      >

        <td>
          <p v-if="$i18n.locale === 'en'">
            {{ item.floor_name }}
          </p>    <p v-else="$i18n.locale === 'ar'">
          {{ item.floor_name_loc }}
        </p>
        </td>


        <td>{{ item.no_of_rooms }}</td>



        <td>
          <VChip
            class="ma-2"
            style="color:mediumpurple;"
            v-if="item.active == 1"
          >
            <VIcon
              start
              icon="mdi-account-circle-outline"
            />
            active
          </VChip>
          <VChip
            class="ma-2"
            style="color:red;"
            v-else="item.active == 0"
          >
            <VIcon
              start
              icon="mdi-account-circle-outline"
            />
            not active
          </VChip>
        </td>


        <td style="table-layout: fixed ">
          <VBtn
            color="primary"
            @click="Delete(item.id)"
          >
            <VIcon icon="mdi-delete" />
          </VBtn>
        </td>
        <td>
          <VBtn
            color="primary"
          >
            <VRow>
              <VDialog
                v-model="dialog3"
                persistent
                width="1024"
              >
                <template #activator="{ props }">
                  <VBtn
                    v-bind="props"
                    @click="Updates(item)"
                  >
                    <VIcon icon="mdi-file-edit-outline" />
                  </VBtn>
                </template>
                <VCard>
                  <VCardTitle>
                    <span class="text-h5">UPDATE New Room Type</span>
                  </VCardTitle>
                  <VCardText>
                    <VContainer>
                      <VRow>

                        <VCol
                          cols="12"
                          sm="6"
                          md="6"
                        >
                          <VTextField
                            v-model="floor_name_edit"
                            label="floor type name"
                            type="text"
                            persistent-placeholder
                          />
                        </VCol>
                        <VCol
                          cols="12"
                          sm="6"
                          md="6"
                        >
                          <VTextField
                            v-model="floor_name_loc_edit"
                            label="اسم الطابق"
                            type="text"
                            persistent-placeholder
                          />
                        </VCol>
                        <VCol
                          cols="12"
                          sm="6"
                          md="6"
                        >
                          <VTextField
                            v-model="no_of_rooms_edit"
                            label="number of rooms"
                            persistent-placeholder
                            type="number"
                          />
                        </VCol>

                        <VCol
                          cols="12"
                          sm="6"
                          md="6"
                        >
                          <VTextField
                            v-model="sort_order_edit"
                            label="sort order price"
                            persistent-placeholder
                            type="number"
                          />
                        </VCol>



                        <VCol
                          cols="12"
                          sm="6"
                          md="6"
                        >
                          <VCheckbox
                            v-model="active_edit"
                            persistent-placeholder
                            :label="`room type active: ${active_edit.toString()}`"
                          />
                        </VCol>
                      </VRow>
                    </VContainer>
                  </VCardText>
                  <VCardActions>
                    <VSpacer />
                    <VBtn
                      color="blue-darken-1"
                      variant="text"
                      @click="dialog3 = false"
                    >
                      Close
                    </VBtn>
                    <VBtn
                      color="blue-darken-1"
                      variant="text"
                      @click="updateUser"
                    >
                      Submit
                    </VBtn>
                  </VCardActions>
                </VCard>
              </VDialog>
            </VRow>
          </VBtn>
        </td>
      </tr>
      </tbody>
      <br>
      <caption>List Of Data( 1 )</caption>
    </VTable>
    <div style="float: right">
      <VPagination
        v-model="page"
        :length="10"
        :total-visible="7"
        :data="roles"
        @pagination-change-page="getPosts"
      />
    </div>
  </div>
</template>

<script>
import axios from "axios"
import {tr} from "vuetify/locale";

// import xlsx from "xlsx/dist/xlsx.full.min"
// import pdfMake from "pdfmake/build/pdfmake"
// import pdfFonts from "pdfmake/build/vfs_fonts"
// import router from "@/router"
//
// pdfMake.vfs = pdfFonts.pdfMake.vfs

export default {
  name: "FloorTable",

  // eslint-disable-next-line vue/component-api-style
  data(){
    return {
      search:'',
      dialog: false,
      dialog3: false,
      Floors:[],
      floorid:'',
      id:'',

      floor_name : '',
      floor_name_loc:'',
      no_of_rooms:'',
      sort_order:'',
      active:true,



      floor_name_edit:'',
      floor_name_loc_edit:'',
      no_of_rooms_edit:'',
      sort_order_edit:'',
      active_edit:'',



    }
  },

  // eslint-disable-next-line vue/component-api-style
  computed:{
    filterData(){
      return  this.Floors.filter(user =>user.floor_name.includes(this.search))
    },
  },
  // eslint-disable-next-line vue/component-api-style
  mounted() {
    this.getAllFloors()
  },

  // eslint-disable-next-line vue/component-api-style
  methods:{

    getAllFloors(){
      axios
        .get('api/floor')
        .then(res => {

          this.Floors = res.data
          console.log(this.Floors)
        })
    },

    insertAlert() {
      const Toast = this.$swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: toast => {
          toast.addEventListener('mouseenter', this.$swal.stopTimer)
          toast.addEventListener('mouseleave', this.$swal.resumeTimer)
        },
      })

      Toast.fire({
        icon: 'success',
        title: 'Data Added successfully',
        color: 'green',
        timer: 5000,
      })
    },

    DeleteAlert() {

      this.$swal.fire({
        icon: 'error',
        title: 'Do you want to Delete',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton:false,
        denyButtonText: `Deleted`,
      }).then(result => {

        if (result.isDenied) {
          this.deleteData()

          const Toast = this.$swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: toast => {
              toast.addEventListener('mouseenter', this.$swal.stopTimer)
              toast.addEventListener('mouseleave', this.$swal.resumeTimer)
            },
          })

          Toast.fire({
            icon: 'success',
            title: `Data ${this.room_name_en} Deleted successfully`,
            color: 'red',
            timer: 10000,
          })
        }
      })
    },


    UpdateAlert() {
      const Toast = this.$swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: toast => {
          toast.addEventListener('mouseenter', this.$swal.stopTimer)
          toast.addEventListener('mouseleave', this.$swal.resumeTimer)
        },
      })

      Toast.fire({
        icon: 'info',
        title: 'updateed is successfully',
        color: 'mediumpurple',
        timer: 5000,
      })
    },

    exportExecl(){
      const XLSX = xlsx
      const workbook = XLSX.utils.book_new()
      const worksheet = XLSX.utils.aoa_to_sheet(this.framework1)

      XLSX.utils.book_append_sheet(workbook, worksheet, "framework")
      XLSX.writeFile(workbook,"users.xlsx")
    },

    Downpdf(){
      let docDefinition = {
        content: [
          {
            layout: 'lightHorizontalLines',
            table: {
              headerRows: 1,
              widths: [ '*', "auto",100,"*"],

              body:  this.framework1,

            },
          },
        ],
      }

      // pdfMake.createPdf(docDefinition).open()
      pdfMake.createPdf(docDefinition).download()

      // pdfMake.createPdf(docDefinition).print()

    },
    async  Add(){

      try {
        const user = await axios.post(
          "api/floor/",
          {
            floor_name: this.floor_name,
            floor_name_loc: this.floor_name_loc,
            no_of_rooms: this.no_of_rooms,
            sort_order: this.sort_order,
            active: false,
          },
        )

        console.log(user)
        this.getAllFloors()
        this.dialog = false
        this.insertAlert()
      } catch(e) {
        console.log(e)
      }
    },


    async  Delete(GetId){
      this.floorid = GetId
      this.DeleteAlert()
    },


    deleteData(){
      console.log(this.floorid)
      axios
        .delete(`api/floor/${this.floorid}`)
        .then(response => (this.Floors = response.data))
      this.getAllFloors()
    },



    async  Updates(Getdata){

      this.floorid = Getdata

      this.floor_name_edit = Getdata.floor_name
      this.floor_name_loc_edit = Getdata.floor_name_loc
      this.no_of_rooms_edit = Getdata.no_of_rooms
      this.sort_order_edit = Getdata.sort_order
      this.active_edit = Getdata.active=0?false:true



    },


    async updateUser() {
      try {
        const user = await axios.put(

          `api/floor/${this.floorid.id}`,
          {

            floor_name: this.floor_name_edit,
            floor_name_loc: this.floor_name_loc_edit,
            no_of_rooms: this.no_of_rooms_edit,
            sort_order: this.sort_order_edit,
            active: this.active_edit,

          },
        )

        console.log(user)
        this.getAllFloors()
        this.dialog3 = false
        this.UpdateAlert()
      } catch(e) {
        console.log(e)
      }

    },


  },
}
</script>

<style>
/* width */
::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: mediumpurple;
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: rgba(147, 112, 219, .6);  ;
}
</style>
