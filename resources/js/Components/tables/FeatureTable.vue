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
              <span class="text-h5">Add New feature</span>
            </VCardTitle>
            <VCardText>
              <VContainer>
                <VRow>
                  <VCol
                    cols="12"
                    sm="5"
                    md="5"
                  >
                    <VTextField
                      v-model="feature_name"
                      label="feature name"
                      persistent-placeholder
                      type="text"
                    />
                  </VCol>


                  <VCol
                    cols="12"
                    md="4"
                    sm="4"
                  >
                    <VSelect
                      v-model="period_type"
                      :items="period_types"
                      item-title="period type"
                      item-value="id"
                      persistent-placeholder
                      label="period type"
                    ></VSelect>
                  </VCol>
                  <VCol
                    cols="12"
                    sm="3"
                    md="3"
                  >
                    <VTextField
                      v-model="periodicity"
                      label="period city"
                      type="number"
                      persistent-placeholder
                    />
                  </VCol>
                  <VCol
                    cols="12"
                    sm="4"
                    md="4"
                  >
                    <VCheckbox
                      v-model="consumable"
                      :label="`consumable: ${consumable.toString()}`"
                    />
                  </VCol>

                  <VCol
                    cols="12"
                    sm="4"
                    md="4"
                  >
                    <VCheckbox
                      v-model="post_paid"
                      :label="`post paid: ${post_paid.toString()}`"
                    />
                  </VCol>

                  <VCol
                    cols="12"
                    sm="4"
                    md="4"
                  >
                    <VCheckbox
                      v-model="quata"
                      :label="`quota: ${quata.toString()}`"
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
          <th class="text-left">
            no.
          </th>
          <th class="text-left">
            feature name
          </th>
          <th class="text-left">
            consumable
          </th>
          <th class="text-left">
            periodicity
          </th>
          <th class="text-left">
            periodicity_type
          </th>
          <th class="text-left">
            post paid
          </th>
          <th class="text-left">
            quata
          </th>
          <th class="text-left">
            Update
          </th>
        </tr>
      </thead>


      <tbody>
        <tr
          v-for="(item , index) in filterData"
          :key="item.id"
          style="text-align: left"
        >
          <td> {{ ++index }}</td>

          <td>{{ item.feature_name }}</td>
          <td>{{ item.consumable }}</td>
          <td>{{ item.periodicity_of_feature }}</td>
          <td>{{ item.periodicity_type }}</td>

          <td>{{ item.postpaid }}</td>
          <td>{{ item.quota }}</td>
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
                      <span class="text-h5">Update Feature data</span>
                    </VCardTitle>
                    <VCardText>
                      <VContainer>
                        <VRow>
                          <VCol
                            cols="12"
                            sm="5"
                            md="5"
                          >
                            <VTextField
                              v-model="feature_name_edit"
                              label="feature Name edit"
                            />
                          </VCol>
                          <VCol
                            cols="12"
                            md="4"
                            sm="4"
                          >
                            <VSelect
                              v-model="period_type_edit"
                              :items="period_types"
                              item-title="period type"
                              item-value="id"
                              persistent-placeholder
                              label="period type"
                            ></VSelect>
                          </VCol>
                          <VCol
                            cols="12"
                            sm="3"
                            md="3"
                          >
                            <VTextField
                              v-model="periodicity_edit"
                              label="periodicity"
                              type="number"
                            />
                          </VCol>

                          <VCol
                            cols="12"
                            sm="4"
                            md="4"
                          >
                            <VCheckbox
                              v-model="consumable_edit"
                              :label="`consumable: ${consumable_edit.toString()}`"
                            />

                          </VCol>
                          <VCol
                            cols="12"
                            sm="4"
                            md="4"
                          >
                            <VCheckbox
                              v-model="quata_edit"
                              :label="`quota: ${quata_edit.toString()}`"
                            />
                          </VCol>

                          <VCol
                            cols="12"
                            sm="4"
                            md="4"
                          >
                            <VCheckbox
                              v-model="post_paid_edit"
                              :label="`post paid: ${post_paid_edit.toString()}`"
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

export default {
  name: "FeatureTable",

  // eslint-disable-next-line vue/component-api-style
  data(){
    return {
      name: "user_table",
      search:'',
      page: 1,
      dialog: false,
      dialog3: false,
      Features:[],
      featureid:'',
      feature_id:'',
      period_types:['Day','Week','Month','Year'],

      feature_name:'',
      period_type:'',
      consumable:true,
      periodicity:'',
      quata:true,
      post_paid:true,

      feature_name_edit:'',
      period_type_edit:'',
      consumable_edit:'',
      periodicity_edit:'',
      quata_edit:'',
      post_paid_edit:'',


    }
  },

  // eslint-disable-next-line vue/component-api-style
  computed:{
    filterData(){

      return  this.Features.filter(user =>user.feature_name.includes(this.search))
    },
  },



  // eslint-disable-next-line vue/component-api-style
  mounted() {
    this.getAllFeature()
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


    getAllFeature(){
      axios
        .get('api/feature')
        .then(response => (this.Features = response.data.data))
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
          "api/feature",
          {
            name: this.feature_name,
            consumable: this.consumable,
            quota: this.quata,
            postpaid: this.post_paid,
            periodicity: this.periodicity,
            periodicity_type: this.period_type,

          },
          console.log(this.period_type),
        )

        console.log(user)
        this.getAllFeature()
        this.dialog = false
        this.insertAlert()
      } catch(e) {
        console.log(e)
      }
    },



    async  Updates(Getdata){

      this.featureid = Getdata


      this.feature_name_edit= Getdata.feature_name,
      this.periodicity_edit= Getdata.periodicity_of_feature,
      this.period_type_edit= Getdata.periodicity_type

      this.consumable_edit= Getdata.consumable=0?false:true
      this.quata_edit= Getdata.quota=0?false:true
      this.post_paid_edit= Getdata.post_paid=1?true:false

    },


    async updateUser() {


      try {
        const user = await axios.put(
          `api/feature/${this.featureid.feature_id}`,
          {
            name: this.feature_name_edit,
            periodicity: this.periodicity_edit,
            periodicity_type: this.period_type_edit,
            consumable: this.consumable_edit,
            quota: this.quata_edit,
            postpaid: this.post_paid_edit,

          },
        )

        console.log(user)
        this.getAllFeature()
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
