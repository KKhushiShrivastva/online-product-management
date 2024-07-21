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
                    <div class="card-body">

                        <h5 class="card-title"></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total Users</h6>
                        <p class="btn btn-secondary">10</p>
                    </div>
                </div>

            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title"></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total Products</h6>
                        <p class="btn btn-secondary">27</p>
                    </div>
                </div>

            </div>
        
            <div class="col-4">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title"></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Products in stock</h6>
                        <p class="btn btn-secondary">1</p>
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
<style>
.card-subtitle{
    font-size:  14px;
}
</style>

