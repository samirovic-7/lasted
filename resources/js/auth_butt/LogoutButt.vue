<template>

  <div class="demo-space-x">

    <VBtn class="logout_butt" color="error" @click="logout">
      log out
    </VBtn>

  </div>
</template>

<script>
import router from "@/router"
import { isUserLoggedIn } from "@/router/utils"

export default {
  // eslint-disable-next-line vue/component-api-style
  data() {
    return {
      localToken:"",
      status:"",
    }
  },
  name: "LogoutButt",
  // eslint-disable-next-line vue/component-api-style
  methods:{
    logout(){
      localStorage.clear()

      router.push("login")

      console.log(this.localToken)

      this.localToken = localStorage.getItem('accessToken')
      this.localToken = localStorage.getItem('accessToken')
      this.status = localStorage.getItem('status')
      this.status = localStorage.getItem('status')

      console.log(this.status)
    },
  },

}
</script>

<style scoped>

.logout_butt{
  margin: 5% auto;
  width: 70%;
}

</style>
