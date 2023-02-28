<script setup>
import {
  lengthValidator,
  requiredValidator,
  integerValidator,
  betweenValidator,
} from '@validators'
</script>

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
              <span class="text-h5">Add New Room</span>
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
                      v-model="room_name_en"
                      label="Room Name"
                      persistent-placeholder
                      type="text"
                    />
                  </VCol>
                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <VTextField
                      v-model="room_name_loc"
                      label="Room Name Loc"
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
                      v-model="room_max_pax"
                      label="Room max pax"
                      type="text"
                      persistent-placeholder
                      :rules="[requiredValidator, betweenValidator(room_max_pax, 1,99), integerValidator]"
                    />
                  </VCol>
                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <VTextField
                      v-model="room_phone_no"
                      label="Room Phone No"
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
                      v-model="room_phone_ext"
                      label="Room Phone Ext"
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
                      v-model="room_key_code"
                      label="Room Key Code"
                      persistent-placeholder
                      type="number"
                      :rules="[requiredValidator, lengthValidator(room_key_code, 3), integerValidator]"
                    />
                  </VCol>


                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <VTextField
                      v-model="sort_order"
                      label="sort order"
                      persistent-placeholder
                      type="number"
                    />
                  </VCol>

                  <VCol
                    cols="12"
                    sm="6"
                  >
                    <VSelect
                      v-model="roomType_selected"
                      :items="roomType"
                      item-title="rm_type_name"
                      item-value="id"
                      label="Room Type"
                    ></VSelect>
                  </VCol>
                  <VCol
                    cols="12"
                    sm="6"
                  >
                    <VSelect
                      :items="roomType"
                      item-title="floor_id"
                    ></VSelect>
                  </VCol>
                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <VTextField
                      v-model="room_key_options"
                      label="Room Key Options"
                      persistent-placeholder
                      type="number"
                      :rules="[requiredValidator, lengthValidator(room_key_options, 3), integerValidator]"
                    />
                  </VCol>

                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >

                    <VCheckbox
                      v-model="room_connection"
                      :label="`room connection: ${room_connection.toString()}`"
                    ></VCheckbox>
                  </VCol>

                  <VCol
                    cols="12"
                    sm="6"
                    md="6"
                  >

                    <VCheckbox

                      v-model="room_active"
                      :label="`room Active: ${room_active.toString()}`"
                    ></VCheckbox>


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
          <th class="text-left">
            Num
          </th>
          <th class="text-left" v-if="$i18n.locale === 'en'">
            room name
          </th>
          <th class="text-left"  v-else="$i18n.locale === 'ar'">
            اسم الغرفة
          </th>
          <th class="text-left">
            rm_type_name
          </th>
          <th class="text-left">
            room max pax
          </th>
          <th class="text-left">
            floor_name
          </th>
          <th class="text-left">
            room_active
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
          v-for="(item , index) in roles"
          :key="item.id"
          style="text-align: left"

        >
          <td> {{++index}}</td>
          <td>
            <p v-if="$i18n.locale === 'en'">{{ item.room_name_en }}</p>
            <p v-else="$i18n.locale === 'ar'">{{ item.room_name_loc }}</p>
          </td>
          <td>{{ item.roomType.rm_type_name }}</td>
          <td>{{ item.room_max_pax }}</td>
          <td>{{ item.floors.floor_name  }}</td>
          <td>
            <VChip
              class="ma-2"
                style="color:mediumpurple;"
              v-if="item.room_active == 1"
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
              v-else="item.room_active == 0"
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
              @click="Delete(item.room_id)"
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
                      <span class="text-h5">Update User Profile</span>
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
                              v-model="room_name_edit"
                              label="Room Name"
                            />
                          </VCol>
                          <VCol
                            cols="12"
                            sm="6"
                            md="6"
                          >
                            <VTextField
                              v-model="room_name_loc_edit"
                              label="Room Name Loc"
                            />
                          </VCol>
                          <VCol
                            cols="12"
                            sm="6"
                            md="6"
                          >
                            <VTextField
                              v-model="room_max_pax_edit"
                              label="Room max pax"
                              type="text"
                            />
                          </VCol>
                          <VCol
                            cols="12"
                            sm="6"
                            md="6"
                          >
                            <VTextField
                              v-model="room_phone_no_edit"
                              label="Room Phone No"
                              persistent-hint
                              type="number"
                            />
                          </VCol>
                          <VCol
                            cols="12"
                            sm="6"
                            md="6"
                          >
                            <VTextField
                              v-model="room_phone_ext_edit"
                              label="Room Phone Ext"
                              type="number"
                            />
                          </VCol>
                          <VCol
                            cols="12"
                            sm="6"
                            md="6"
                          >
                            <VTextField
                              v-model="room_key_code_edit"
                              label="Room Key Code"
                              persistent-hint
                              type="number"
                            />
                          </VCol>

                          <VCol
                            cols="12"
                            sm="6"
                            md="6"
                          >
                            <VTextField
                              v-model="room_sort_edit"
                              label="sort order"
                              persistent-hint
                              type="number"
                            />
                          </VCol>

                          <VCol
                            cols="12"
                            sm="6"
                          >
                            <VSelect
                              v-model="room_type_select_edit"
                              :items="roomType"
                              item-title="rm_type_name"
                              item-value="id"
                              label="Room Type"
                            ></VSelect>
                          </VCol>
                          <VCol
                            cols="12"
                            sm="6"
                          >
                            <VSelect

                              label="Floor Type"
                            />
                          </VCol>
                          <VCol
                            cols="12"
                            sm="6"
                            md="6"
                          >
                            <VTextField
                              v-model="room_key_options_edit"
                              label="Room Key Options"
                              persistent-hint
                              type="number"
                            />
                          </VCol>

                          <VCol
                            cols="12"
                            sm="6"
                            md="6"
                          >

                            <VCheckbox
                              v-model="room_active_edit"
                              :label="`room active edit: ${room_active_edit.toString()}`"
                            ></VCheckbox>
                          </VCol>



                          <VCol
                            cols="12"
                            sm="6"
                            md="6"
                          >

                            <VCheckbox
                              v-model="room_connection_edit"
                              :label="`room connection edit: ${room_connection.toString()}`"
                            ></VCheckbox>
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
                        Update
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

// import xlsx from "xlsx/dist/xlsx.full.min"
// import pdfMake from "pdfmake/build/pdfmake"
// import pdfFonts from "pdfmake/build/vfs_fonts"
// import router from "@/router"
//
// pdfMake.vfs = pdfFonts.pdfMake.vfs

export default {
  name: "RoomsTable",

  // eslint-disable-next-line vue/component-api-style
  data(){
    return {
      name: "user_table",
      search:'',
      page: 1,
      dialog: false,
      dialog3: false,
      roles:[],
      itemid: '',
      itemid_edit: '',
      room_id: '',

      room_id_edit: '',
      room_name_edit: '',
      room_name_loc_edit: '',
      room_max_pax_edit: '',
      room_phone_no_edit: '',
      room_phone_ext_edit: '',
      room_key_code_edit: '',
      room_connection_edit: '',
      room_status_edit: '',
      room_hk_status_edit: '',
      room_sort_edit: '',
      room_type_select_edit: '',
      room_key_options_edit: '',
      room_active_edit: '',

      room_name_en: '',
      room_name_loc  : '',
      room_max_pax  : '',
      room_phone_no  : '',
      room_phone_ext  : '',
      room_key_code : ref('')  ,
      room_key_options : ref('') ,
      room_connection  : true,
      fo_status  : 'VA',
      room_active  : true,
      hk_stauts  : 'CL',
      sort_order  : '',
      roomType_selected:'',

      roomfloor_selected:'',


      roomType :[],

      floorsType: [],

      framework1:[
        ["A1", "B1", "C1"],
        ["A2", "B2", "C2"],
        ["A3", "B3", "C3"],
      ],

    }
  },

  // eslint-disable-next-line vue/component-api-style
  computed:{
    filterData(){

      return  this.roles.filter(user =>user.rm_name_en.includes(this.search))
    },
  },



  // eslint-disable-next-line vue/component-api-style
  mounted() {
    this.getAllData()
    this.getFloors()
    this.getRoomsTypes()
  },

  // eslint-disable-next-line vue/component-api-style
  methods:{
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

    console(){
      console.log('done')
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


    getAllData(){
      axios
        .get('api/rooms')
        .then(response => (this.roles = response.data.data))
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
          "api/rooms",
          {
            room_name_en: this.room_name_en,
            room_name_loc: this.room_name_loc,
            room_max_pax: this.room_max_pax,
            room_phone_no: this.room_phone_no,
            room_phone_ext: this.room_phone_ext,
            room_type_id: this.roomType_selected,
            room_connection: this.room_connection,
            fo_status: this.fo_status,
            room_active: this.room_active,
            room_key_options: this.room_key_options,
            room_key_code: this.room_key_options,
            hk_stauts: this.hk_stauts,
            sort_order: this.sort_order,
            floor_id:1,
          },
        )

        console.log(user)
        this.getAllData()
        this.dialog = false
        this.insertAlert()
      } catch(e) {
        console.log(e)
      }
    },


    async  Delete(GetId){
      this.itemid = GetId
      this.DeleteAlert()
    },

    deleteData(){
      axios
        .delete(`api/rooms/${this.itemid}`)
        .then(response => (this.roles = response.data.data))
      this.getAllData()
    },


    async  Updates(Getdata){


      this.itemid = Getdata



      this.room_id_edit= Getdata.room_id,
      this.room_name_edit= Getdata.room_name_en,
      this.room_name_loc_edit= Getdata.room_name_loc,
      this.room_max_pax_edit= Getdata.room_max_pax,
      this.room_phone_no_edit= Getdata.room_phone_no,
      this.room_phone_ext_edit= Getdata.room_phone_ext,
      this.room_key_code_edit= Getdata.room_key_code,
      this.room_connection_edit= Getdata.room_connection=0?false:true,
      this.room_status_edit= Getdata.fo_status,
      this.room_hk_status_edit= Getdata.hk_stauts,
      this.room_sort_edit= Getdata.sort_order,
      this.room_key_options_edit= Getdata.room_key_options,
      this.room_active_edit= Getdata.room_active=0?false:true,
      this.room_type_select_edit= Getdata.roomType.id

      console.log(this.itemid.room_connection_edit)
    },


    async updateUser() {



      console.log(this.room_connection_edit)

      try {
        const user = await axios.put(
          `api/rooms/${this.itemid.room_id}`,
          {
            room_name_en: this.room_name_edit,
            room_name_loc: this.room_name_loc_edit,
            room_max_pax: this.room_max_pax_edit,
            room_phone_no: this.room_phone_no_edit,
            room_phone_ext: this.room_phone_ext_edit,
            room_type_id: this.room_type_select_edit,
            fo_status: this.room_status_edit,
            room_active: this.room_active_edit,
            room_key_options: this.room_key_options_edit,
            room_key_code: this.room_key_code_edit,
            hk_stauts: this.room_hk_status_edit,
            sort_order: this.room_sort_edit,
            room_connection: this.room_connection_edit,

          },
        )

        console.log(user)
        this.getAllData()
        this.dialog3 = false
        this.UpdateAlert()
      } catch(e) {
        console.log(e)
      }

    },





    async getRoomsTypes(){
      axios
        .get('api/room_types')
        .then(response => (this.roomType = response.data))
    },

    async getFloors(){
      axios
        .get('api/floor')
        .then(response => (this.floorsType = response.data))
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
