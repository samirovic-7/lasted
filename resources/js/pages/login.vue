<script setup>
import AuthProvider from '@/views/pages/authentication/AuthProvider.vue'
import { useGenerateImageVariant } from '@core/composable/useGenerateImageVariant'
import { VNodeRenderer } from '@layouts/components/VNodeRenderer'
import { themeConfig } from '@themeConfig'

import authV2LoginIllustrationBorderedDark from '@images/pages/auth-v2-login-illustration-bordered-dark.png'
import authV2LoginIllustrationBorderedLight from '@images/pages/auth-v2-login-illustration-bordered-light.png'
import authV2LoginIllustrationDark from '@images/pages/auth-v2-login-illustration-dark.png'
import authV2LoginIllustrationLight from '@images/pages/auth-v2-login-illustration-light.png'
import authV2MaskDark from '@images/pages/misc-mask-dark.png'
import authV2MaskLight from '@images/pages/misc-mask-light.png'

const authThemeImg = useGenerateImageVariant(authV2LoginIllustrationLight, authV2LoginIllustrationDark, authV2LoginIllustrationBorderedLight, authV2LoginIllustrationBorderedDark, true)
const authThemeMask = useGenerateImageVariant(authV2MaskLight, authV2MaskDark)
const isPasswordVisible = ref(false)

const rememberMe = ref(false)
</script>

<template>
  <VRow
    no-gutters
    class="auth-wrapper"
  >
    <VCol
      lg="8"
      class="d-none d-lg-flex"
    >
      <div class="position-relative auth-bg rounded-lg w-100 ma-8 me-0">
        <div class="d-flex align-center justify-center w-100 h-100">
          <VImg
            max-width="505"
            :src="authThemeImg"
            class="auth-illustration mt-16 mb-2"
          />
        </div>

        <VImg
          :src="authThemeMask"
          class="auth-footer-mask"
        />
      </div>
    </VCol>

    <VCol
      cols="12"
      lg="4"
      class="d-flex align-center justify-center"
    >
      <VCard
        flat
        :max-width="500"
        class="mt-12 mt-sm-0 pa-4"
      >
        <VCardText>
          <div style="text-align: center;">
            <VNodeRenderer
              :nodes="themeConfig.app.logo"
              class="mb-6 d-inline"
            />
            <h2 style="display: inline;">
              Vuexy
            </h2>
          </div>
          <h5 class="text-h5 font-weight-semibold mb-1 mt-5">
            Welcome to {{ themeConfig.app.title }}! 👋🏻
          </h5>
          <p class="mt-6">
            Please sign-in to your account and start the adventure
          </p>
        </VCardText>

        <VCardText>
          <VForm @submit.prevent="onSubmit">
            <VRow>
              <VCol
                cols="12"
              >
                <VTextField
                  v-model="userid"
                  :type="type"
                  placeholder="Email OR Phone"
                />
              </VCol>

              <!-- password -->
              <VCol cols="12">
                <VTextField
                  v-model="password"
                  label="Password"
                  :rules="[requiredValidator]"
                  :type="isPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  @click:append-inner="isPasswordVisible = !isPasswordVisible"
                />
                <div class="d-flex align-center flex-wrap justify-space-between mt-2 mb-4">
                  <VCheckbox
                    v-model="rememberMe"
                    label="Remember me"
                  />
                  <a
                    class="text-primary ms-2 mb-1"
                    href="#"
                  >
                    Forgot Password?
                  </a>
                </div>

                <VBtn
                  block
                  type="submit"
                >
                  Login
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>

<script>
import axios from "axios"

import router from "@/router"

export default {
  state: {
    accessToken: null,
    status: null,
    refreshToken: null,
  },
  // eslint-disable-next-line vue/component-api-style
  data() {
    return {
      userid: '',
      password: '',
      type: 'text',
    }
  },
  // eslint-disable-next-line vue/component-api-style
  mounted() {


    let user = localStorage.getItem('key-info')
    if (user) {
      router.push("/")
    }
  },
  // eslint-disable-next-line vue/component-api-style
  methods: {

    async onSubmit() {

      let URL = ''
      if(!isNaN(this.userid)) {
        URL = `http://127.0.0.1:8000/api/user-login?phonenumber=${this.userid}&password=${this.password}`
      }else {
        URL = `http://127.0.0.1:8000/api/user-login?email=${this.userid}&password=${this.password}`
      }

      let result = await axios.post(URL,this.data)
        .then(

          result => {
            if (result.status === 200){
              localStorage.setItem('key-info',JSON.stringify(result.data))
              localStorage.setItem('accessToken', result.data.token)
              localStorage.setItem('status', result.data.status)
              router.push("/")
            }
          })
    },
  },
}
</script>

<style lang="scss">
@use "@core-scss/template/pages/page-auth.scss";
.change{
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}
</style>


<route lang="yaml">
meta:
  layout: blank
  action: read
  subject: Auth
  redirectIfLoggedIn: true
</route>
