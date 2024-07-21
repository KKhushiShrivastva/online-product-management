<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>


<template>

  <Head title="View Product" />
  <AuthenticatedLayout>
    <div class="container mt-5">
      <h2>View Product</h2>

      <!-- <form @submit.prevent="submitForm" enctype="multipart/form-data">
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
          <label for="price" class="form-label">Product Price</label>
          <input type="number" class="form-control" id="price" v-model="localProduct.price" required />
        </div>
        
      </form> -->
      <div class="card" style="width: 18rem;">
  <div class="card-body">
    <div class="mb-3">
      <label for="description" class="form-label">Image Preview</label>
      <img v-if="imagePreview" :src="imagePreview" alt="Preview" class="img-fluid mb-3">
      <img src="/product_image/default_image.png" alt="Default Image" class="img-fluid mb-3" width="200" v-else>

      <h5 class="card-title">{{ localProduct.name }}</h5>
      <p class="card-subtitle mb-2 text-muted">{{ localProduct.description }}</p>
      <h4 class="card-subtitle mb-2 text-muted">{{ localProduct.price }}</h4>

      <button class="btn btn-secondary" @click="navigationBack">Back to List</button>
    </div>
  </div>
</div>

    </div>
  </AuthenticatedLayout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

export default {
  props: {
    product: Object,

  },
  data() {
    return {
      localProduct: {
        name: '',
        price: '',
        description: '',
        product_image: '',
        stock: '',
      },
      imagePreview: null, 
    };
  },
  methods: {
    navigationBack(){
      Inertia.visit('/manage-product');
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
    fetchProduct(productId) {
      console.log(productId);

      axios
        .get(`/api/${productId}/products`)
        .then((response) => {
          this.product = response.data;
        })
        .catch((error) => {
          console.error('There was an error fetching the product:', error);
        });
    },
    submitForm() {
  console.log("on submit: ", this.localProduct);

  let formData = new FormData();
  formData.append('name', this.localProduct.name);
  formData.append('price', this.localProduct.price);
  formData.append('description', this.localProduct.description);
  formData.append('stock', this.localProduct.stock);

  if (this.localProduct.product_image) {
    formData.append('product_image', this.localProduct.product_image);
  }

  axios
    .post(`/api/products/${this.localProduct.id}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })
    .then((response) => {
      Inertia.visit('/manage-product');
    })
    .catch((error) => {
      console.error('There was an error updating the product:', error);
    });
}
    
  },
  mounted() {
  console.log("mounted:", this.product);
  if (this.product) {
    this.localProduct = { ...this.product, product_image: null };
  }
}
};
</script>

<style scoped>
.container {
  /* max-width: 600px; */
}.img{
  border:5px solid #000000; padding:3px; margin:5px;
  border-radius: 30px;

}
</style>
