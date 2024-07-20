<template>
  <AuthenticatedLayout>
    <Head title="Create Product" />
    <div class="container mt-5">
      <h2>Create Product</h2>
      <form @submit.prevent="submitForm" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input
            type="text"
            class="form-control"
            id="name"
            v-model="localProduct.name"
            required
          />
        </div>

        <div class="mb-3">
          <label for="stock" class="form-label">Quantity in stock</label>
          <input
            type="number"
            class="form-control"
            id="stock"
            v-model="localProduct.stock"
            required
          />
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea
            class="form-control"
            id="description"
            v-model="localProduct.description"
            required
          ></textarea>
        </div>

        <div class="mb-3">
          <label for="product_image" class="form-label">Product Image</label>
          <input
            type="file"
            class="form-control"
            id="product_image"
            @change="handleFileChange"
          />
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Product Price</label>
          <input
            type="number"
            class="form-control"
            id="price"
            v-model="localProduct.price"
            required
          />
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

const localProduct = ref({
  name: '',
  price: '',
  description: '',
  product_image: null,
  stock: '',
});

const handleFileChange = (event) => {
  localProduct.value.product_image = event.target.files[0];
};

const submitForm = async () => {
  const formData = new FormData();
  formData.append('name', localProduct.value.name);
  formData.append('price', localProduct.value.price);
  formData.append('description', localProduct.value.description);
  formData.append('stock', localProduct.value.stock);
  if (localProduct.value.product_image) {
    formData.append('product_image', localProduct.value.product_image);
  }

  try {
    await axios.post('/api/products', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
    Inertia.visit('/manage-product');
  } catch (error) {
    console.error('There was an error creating the product:', error);
  }
};
</script>

<style scoped>
.container {
  max-width: 600px;
}
</style>
