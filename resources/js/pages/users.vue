<template>
   <user_table/>
</template>

<script>
import user_table from "@/Components/tables/user_table.vue"
import axios from "axios"
// import xlsx from "xlsx/dist/xlsx.full.min"
// import pdfMake from "pdfmake/build/pdfmake"
// import pdfFonts from "pdfmake/build/vfs_fonts"
//
// pdfMake.vfs = pdfFonts.pdfMake.vfs

export default {

  components: {
    user_table,
  },
}
</script>
