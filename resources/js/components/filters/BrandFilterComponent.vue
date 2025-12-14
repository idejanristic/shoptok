<template>
    <div v-for="brand in brands" :key="brand.id" class="form-check mb-3 mx-1">
        <input type="checkbox" class="form-check-input" :id="`brand-${brand.id}`" :value="brand.id"
            :checked="isSelected(brand.id)" @change="toggleBrand(brand.id)" />

        <label class="form-check-label" :for="`brand-${brand.id}`">
            {{ brand.name }}
            <span class="badge text-danger">
                {{ brand.products_count }}
            </span>
        </label>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { useFilterStore } from '@/stores/filterStore'

defineProps({
    brands: {
        type: Array,
        required: true
    }
})

const filter = useFilterStore()

const selectedBrands = computed({
    get: () => filter.filterBrands || [],
    set: (val) => filter.setSelectedBrands(val)
})

const toggleBrand = (id) => {
    if (selectedBrands.value.includes(id)) {
        selectedBrands.value = selectedBrands.value.filter(b => b !== id)
    } else {
        selectedBrands.value = [...selectedBrands.value, id]
    }
}

const isSelected = (id) => selectedBrands.value.includes(id)
</script>
