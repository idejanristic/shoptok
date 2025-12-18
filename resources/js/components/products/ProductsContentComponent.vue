<template>
    <div class="sort-area">
        <products-sorter-component @change="reFetchPageData" :total="total" :perPage="pageData.perPage"
            :sortBy="pageData.sortBy" />
    </div>

    <div class="position-relative">
        <loader-overlay :show="loading" :size="44" color="red" />

        <products-filter-component :brands="activeBrands" :tags="activeTags" @remove-brand="onRemoveBrand"
            @remove-tag="onRemoveTag" @clear-all="onClearAll" />

        <products-list-component :products="products" />
    </div>

    <div v-if="!loading" class="d-flex justify-content-center mt-3">
        <pagination-component :pagination="pagination" @changePage="fetchPageData" />
    </div>
</template>

<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import { useStorage } from '@/composables/useStorage';
import { useFilterStore } from '@/stores/filterStore'

const props = defineProps({
    url: {
        type: String,
        required: true,
    },
    prefix: {
        type: String,
        required: true
    },
    brands: {
        type: Object,
        required: true
    },
    tags: {
        type: Object,
        required: true
    }
})

const filter = useFilterStore()

const products = ref([]);
const total = ref(0);
const loading = ref(true);
const pagination = ref(null);
const pageData = useStorage(
    props.prefix + '_page_data',
    {
        page: 1,
        perPage: 40,
        sortBy: 'minPrice'
    }
);

const fetchData = async () => {
    loading.value = true;

    try {
        const response = await axios.post(props.url, {
            page: pageData.value.page,
            perPage: pageData.value.perPage,
            sortBy: pageData.value.sortBy,
            brands: filter.filterBrands,
            tags: filter.filterTags
        });

        loading.value = false;
        products.value = response.data.data;
        total.value = response.data.total;

        pagination.value = {
            current_page: response.data.current_page,
            last_page: response.data.last_page,
            per_page: response.data.per_page,
            total: response.data.total
        };

        // window.scrollTo({
        //     top: 0,
        //     behavior: 'smooth'
        // });

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

const onRemoveBrand = (id) => {
    filter.removeBrand(id);
}

const onRemoveTag = (id) => {
    filter.removeTag(id);
}

const onClearAll = () => {
    filter.clearAll();
}

const activeBrands = computed(() =>
    props.brands.filter(b =>
        filter.filterBrands.includes(b.id)
    )
)

const activeTags = computed(() =>
    props.tags.filter(t =>
        filter.filterTags.includes(t.id)
    )
)

watch(
    () => [filter.filterBrands, filter.filterTags],
    () => {
        pageData.value.page = 1
        fetchData()
    },
    { deep: true }
)
</script>
