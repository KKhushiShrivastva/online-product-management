<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
  <AuthenticatedLayout>

    <Head title="Create Product" />
    <div class="container mt-5">
      <h2>Create Product</h2>
      <form @submit.prevent="submitForm" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" class="form-control" id="name" v-model="localProduct.name" required />
        </div>

        <div class="mb-3">
          <label for="stock" class="form-label">Quantity in stock</label>
          <input type="number" class="form-control" id="stock" v-model="localProduct.stock" required />
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" v-model="localProduct.description" required></textarea>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Image Preview</label>
          <img v-if="imagePreview" :src="imagePreview" alt="Preview">
          <img src="/product_image/default_image.png" alt="" srcset="" width="200" v-else>
        </div>

        <div class="mb-3">
          <label for="product_image" class="form-label">Product Image</label>
          <input type="file" class="form-control" id="product_image" @change="handleFileChange" />
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Product Price</label>
          <input type="number" class="form-control" id="price" v-model="localProduct.price" required />
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

export default {
  data() {
    return {
      localProduct: {
        name: '',
        price: '',
        description: '',
        product_image: null,
        stock: '',
      },
      imagePreview: null
    };
  },
  methods: {
    async submitForm() {
      const formData = new FormData();
      formData.append('name', this.localProduct.name);
      formData.append('price', this.localProduct.price);
      formData.append('description', this.localProduct.description);
      formData.append('stock', this.localProduct.stock);
      if (this.localProduct.product_image) {
        formData.append('product_image', this.localProduct.product_image);
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
    },
    handleFileChange(event) {
      console.log("image: ", event.target.files[0]);
      const file = event.target.files[0];
      if (file) {
        this.localProduct.product_image = file;
        this.createImagePreview(file);
      }
    },
    createImagePreview(file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.imagePreview = e.target.result;
      };
      reader.readAsDataURL(file);
    }, 
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
}
</style>
