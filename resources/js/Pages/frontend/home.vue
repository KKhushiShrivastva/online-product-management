<template>
    <div class="container mt-5">
      <h2>Product List</h2>
      <button class="btn btn-primary mb-3" @click="goToCreateProduct">Add New Product</button>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr >
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
            <!--  v-for="product in products" :key="product.id" 
            
            <td>{{ product.name }}</td>
            <td>{{ product.price }}</td>
            <td>
              <button class="btn btn-sm btn-warning" @click="editProduct(product.id)">Edit</button>
              <button class="btn btn-sm btn-danger" @click="deleteProduct(product.id)">Delete</button>
            </td> -->
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        products: []
      };
    },
    methods: {
      goToCreateProduct() {
        this.$router.push('/products/create');
      },
      editProduct(id) {
        this.$router.push(`/products/${id}/edit`);
      },
      deleteProduct(id) {
        // API call to delete product
        console.log('Product deleted', id);
        this.products = this.products.filter(product => product.id !== id);
      }
    },
    mounted() {
      // Fetch product data from API
      this.products = [
        { id: 1, name: 'Product 1', price: '100' },
        { id: 2, name: 'Product 2', price: '200' }
      ];
    }
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 800px;
  }
  </style>
  