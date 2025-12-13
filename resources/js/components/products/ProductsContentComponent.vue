<template>
    <div class="sort-area">
        <products-sorter-component />
    </div>

    <products-list-component :products="products" />

    <div v-if="!loading" class="d-flex justify-content-center mt-3">
        <pagination-component :pagination="pagination" @changePage="fetchPage" />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const products = ref([]);
const loading = ref(true);
const pagination = ref(null);


const fetchPage = async (page = 1) => {

    loading.value = true;

    try {
        const response = await axios.get(`/products/ajax?page=${page}`);
        loading.value = false;
        products.value = response.data.data;

        pagination.value = {
            current_page: response.data.current_page,
            last_page: response.data.last_page,
            per_page: response.data.per_page,
            total: response.data.total
        };

    } catch (error) {
        console.error('Failed to fetch products', error);
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchPage();
});
</script>
