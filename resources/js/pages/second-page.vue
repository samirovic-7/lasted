<template>
  <div>
    <VCard title="Create Awesome 🙌">
      <VCardText>This is your second page.</VCardText>
      <VCardText>
        Chocolate sesame snaps pie carrot cake pastry pie lollipop muffin.
        Carrot cake dragée chupa chups jujubes. Macaroon liquorice cookie
        wafer tart marzipan bonbon. Gingerbread jelly-o dragée
        chocolate.
      </VCardText>
    </VCard>
  </div>
</template>

<script>
import router from "@/router"

export default {
  // eslint-disable-next-line vue/component-api-style
  mounted() {
    let user = localStorage.getItem('key-info')
    if (!user){
      router.push("login")
    }
  },
}
</script>
