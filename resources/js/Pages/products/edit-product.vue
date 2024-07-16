<template>
  <div class="container mt-5">
    <h2>{{ isEdit ? 'Edit Product' : 'Add Product' }}</h2>
    <form @submit.prevent="submitForm">
      <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input
          type="text"
          class="form-control"
          id="name"
          v-model="product.name"
          required
        />
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Product Price</label>
        <input
          type="number"
          class="form-control"
          id="price"
          v-model="product.price"
          required
        />
      </div>
      <button type="submit" class="btn btn-primary">
        {{ isEdit ? 'Update' : 'Create' }}
      </button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

export default {
  data() {
    return {
      product: {
        name: '',
        price: '',
      },
      isEdit: false,
    };
  },
  methods: {
    fetchProduct(productId) {
      axios
        .get(`/api/products/${productId}`)
        .then((response) => {
          this.product = response.data;
        })
        .catch((error) => {
          console.error('There was an error fetching the product:', error);
        });
    },
    submitForm() {
      if (this.isEdit) {
        axios
          .put(`/api/products/${this.product.id}`, this.product)
          .then((response) => {
            Inertia.visit('/manage-product');
          })
          .catch((error) => {
            console.error('There was an error updating the product:', error);
          });
      } else {
        axios
          .post('/api/products', this.product)
          .then((response) => {
            Inertia.visit('/manage-product');
          })
          .catch((error) => {
            console.error('There was an error creating the product:', error);
          });
      }
    },
  },
  mounted() {
    const productId = this.$page.props.product?.id;
    if (productId) {
      this.isEdit = true;
      this.fetchProduct(productId);
    }
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
}
</style>
