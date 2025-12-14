<template>
    <div class="sort-area">
        <products-sorter-component @change="reFetchPageData" :perPage="pageData.perPage" :sortBy="pageData.sortBy" />
    </div>

    <div class="position-relative">
        <loader-overlay :show="loading" :size="44" color="red" />
        <products-list-component :products="products" />
    </div>

    <div v-if="!loading" class="d-flex justify-content-center mt-3">
        <pagination-component :pagination="pagination" @changePage="fetchPageData" />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useStorage } from '@/composables/useStorage';

const products = ref([]);
const loading = ref(true);
const pagination = ref(null);
const pageData = useStorage(
    'tv_page_data',
    {
        page: 1,
        perPage: 0,
        sortBy: 'minPrice'
    }
);


const fetchData = async () => {
    loading.value = true;

    var queryString = `page=${pageData.value.page}`;

    if (pageData.value.perPage > 0) {
        queryString += `&perPage=${pageData.value.perPage}`
    }

    if (pageData.value.sortBy) {
        queryString += `&sortBy=${pageData.value.sortBy}`
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

const fetchPageData = (page = 1) => {
    pageData.value.page = page;

    fetchData();
}

const reFetchPageData = (data) => {
    pageData.value.perPage = data.perPage;
    pageData.value.sortBy = data.sortBy;
    pageData.value.page = 1;
    fetchData();
}

onMounted(() => {
    fetchData();
});
</script>
