
<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8 md:mx-auto md:w-full md:max-w-md">
        <h1 class="text-3xl font-semibold mb-4 text-center">Uber</h1>
        <div class="p-5 bg-white rounded-md shadow-md">
            <div class="flex justify-between">
                <button class="py-2 px-4 bg-black text-yellow-50 text-sm font-medium rounded-md">Start Driving</button>
                <button @click="handleRide" class="py-2 px-4 bg-black text-yellow-50 text-sm font-medium rounded-md">Find a ride</button>
            </div>
        </div>
    </div>

</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const handleRide = () => {
    router.push({
        name: 'location'
    })
}
</script>

