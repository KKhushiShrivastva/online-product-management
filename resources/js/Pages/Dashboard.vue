<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />
    <Head title="Manage Product" />


    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Product</h2>
        </template>
        <div class="container mt-5">
            <div class="row"><div class="col-4">
                <div class="card">
                    <a :href="'/profile'">
                    <div class="card-body">

                        <h5 class="card-title"></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total Users</h6>
                        <p class="btn btn-secondary">{{userCount}}</p>
                    </div>
                    </a>
                </div>

            </div>
            <div class="col-4">
                <div class="card">
                    <a :href="'/manage-product'">
                    <div class="card-body">

                        <h5 class="card-title"></h5>
                        <h6 class="card-subtitle mb-2 text-muted"> Total Products</h6>
                        <p class="btn btn-secondary">{{prodCount   }}</p>
                    </div>
                </a>
                </div>

            </div>
        
            <div class="col-4">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title"></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Products in stock</h6>
                        <p class="btn btn-secondary">{{prod_in_stock_count}}</p>
                    </div>
                </div>

            </div></div>
            

        </div>
        <!--  <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> -->

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div> -->
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    prodCount: {
      type: Number,
      required: true,
    },
    userCount: {
      type: Number,
      required: true,
    },
    prod_in_stock_count:{
        type: Number,
      required: true,
    }
  },
};
</script>

<style>
.card-subtitle{
    font-size:  14px;
}
</style>

