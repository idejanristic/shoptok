<template>
    <div class="sort-area">
        <products-sorter-component @change="reFetchData" />
    </div>

    <div class="position-relative">
        <loader-overlay :show="loading" :size="44" color="red" />
        <products-list-component :products="products" />
    </div>

    <div v-if="!loading" class="d-flex justify-content-center mt-3">
        <pagination-component :pagination="pagination" @changePage="fetchPage" />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const products = ref([]);
const loading = ref(true);
const pagination = ref(null);
const currentPage = ref(1);


const fetchPage = async (page = 1, perPage = 0, sortBy = '') => {

    loading.value = true;
    currentPage.value = page;

    var queryString = `page=${page}`;

    if (perPage > 0) {
        queryString += `&perPage=${perPage}`
    }

    if (sortBy) {
        queryString += `&sortBy=${sortBy}`
    }

    try {
        const response = await axios.get(`/products/ajax?${queryString}`);

        loading.value = false;
        products.value = response.data.data;

        pagination.value = {
            current_page: response.data.current_page,
            last_page: response.data.last_page,
            per_page: response.data.per_page,
            total: response.data.total
        };

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

    } catch (error) {
        console.error('Failed to fetch products', error);
    } finally {
        loading.value = false;
    }
};

const reFetchData = (data) => {
    fetchPage(currentPage.value, data.perPage, data.sortBy);
}

onMounted(() => {
    fetchPage();
});
</script>
