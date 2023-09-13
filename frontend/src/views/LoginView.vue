<script setup>
import { vMaska } from 'maska'
import { onMounted, reactive, ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router';

const router = useRouter()

onMounted(() => {
    if (localStorage.getItem('token')) {
        router.push({
            name: 'index'
        })
    }
})

const credentials = reactive({
    phone: null,
    login_code: null
})

const verificationForm = ref(false)

const handleLogin = () => {
    axios.post('http://127.0.0.1:8000/api/login', credentials)
    .then((response) => {
        console.log(response.data)
        verificationForm.value = true
    })
    .catch((error) => {
        console.error(error)
        alert(error.response.data.message)
    })
}

const handleVerification = () => {
    axios.post('http://127.0.0.1:8000/api/login/verify', credentials)
    .then((response) => {
        console.log(response.data)
        localStorage.setItem('token', response.data)
        router.push({
            name: 'index'
        })
    })
    .catch((error) => {
        console.error(error)
        alert(error.response.data.message)
    })
}

</script>

<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm bg-white p-6 rounded-md shadow-sm">
      <form v-if="!verificationForm" class="space-y-6" action="#" method="POST" @submit.prevent="handleLogin">
        <div>
          <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
          <div class="mt-2">
            <input v-maska data-maska="+############" v-model="credentials.phone" id="phone" name="phone" type="text" autocomplete="phone" required="" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
        </div>
      </form>

      <form v-else class="space-y-6" action="#" method="POST" @submit.prevent="handleVerification">
        <div>
          <label for="login_code" class="block text-sm font-medium leading-6 text-gray-900">Login Code</label>
          <div class="mt-2">
            <input v-maska data-maska="#####" v-model="credentials.login_code" id="login_code" name="login_code" type="text" required="" class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Verify</button>
        </div>
      </form>
    </div>
  </div>
</template>


<style>

</style>