<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <AuthenticatedLayout>
    <div class="container mt-5">
      <h2>Product List</h2>
      <button class="btn btn-primary mb-3" @click="goToCreateProduct">Add New Product</button>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td>
              <img :src="'/product_image/' + getImageName(product.product_image)" alt="" srcset="" width="100">
            </td>
            <td>{{ product.name }}</td>
            <td>₹{{ product.price }}</td>
            <td>
              <button class="btn btn-sm btn-warning mgn" @click="editProduct(product.id)">Edit</button>
              <button class="btn btn-sm btn-danger mgn" @click="deleteProduct(product.id)">Delete</button>
              <button class="btn btn-sm btn-info mgn" @click="viewProduct(product.id)">View Product</button>

            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';
export default {
  data() {
    return {
      products: []
    };
  },
  methods: {
    fetchProducts() {
      axios.get('/api/products').then(response => {
        console.log(response);
        this.products = response.data.products;
      }).catch(error => {

        console.error('There was an error fetching the products:', error);
      });
    },
    goToCreateProduct() {
      Inertia.visit('/products/create');
    },
    editProduct(id) {
      console.log("id: ", id);
      Inertia.visit(`/products/${id}/edit`);
    },
    viewProduct(id) {
      Inertia.visit(`/products/${id}`);
    },
    // deleteProduct(id) {
    //   axios.delete(`/api/products/${id}`).then(response => {
    //     this.products = this.products.filter(product => product.id !== id);
    //   }).catch(error => {
    //     console.error('There was an error deleting the product:', error);
    //   });
    // },
    deleteProduct(id) {
      this.$swal({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/api/products/${id}`)
            .then(response => {
              this.products = this.products.filter(product => product.id !== id);
              this.$swal(
                'Deleted!',
                'Your product has been deleted.',
                'success'
              );
            })
            .catch(error => {
              console.error('There was an error deleting the product:', error);
              this.$swal(
                'Error!',
                'There was an error deleting the product.',
                'error'
              );
            });
        }
      });
    },

    // getimagename(image)
    // {
    //   if(image == '' || image === null){
    //     return "default_image.png";
    //   }
    //   return image;
    // }
    getImageName(image) {
      return image || "default_image.png";
    }

  },
  mounted() {
    this.fetchProducts();
  }
};
</script>

<style scoped>
.container {
  max-width: 800px;
}

.container {
  max-width: 800px;
}

.mgn {
  margin-right: 10px;
}
</style>