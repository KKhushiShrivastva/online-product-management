import { createRouter, createWebHistory } from 'vue-router';
import ManageProduct from '@/Pages/products/manage-product.vue';
import CreateProduct from '@/Pages/products/create-product.vue';
import EditProduct from '@/Pages/products/edit-product.vue';

const routes = [
  {
    path: '/manage-product',
    name: 'ManageProduct',
    component: ManageProduct,
    meta: { title: 'Manage Products' }
  },
  {
    path: '/products/create',
    name: 'CreateProduct',
    component: CreateProduct,
    meta: { title: 'Create Product' }
  },
  {
    path: '/products/:id/edit',
    name: 'EditProduct',
    component: EditProduct,
    meta: { title: 'Edit Product' },
    props: true
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
