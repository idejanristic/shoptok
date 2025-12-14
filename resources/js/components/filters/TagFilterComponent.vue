<template>
    <div v-for="tag in tags" :key="tag.id" class="d-inline-block mb-2 mx-1">
        <button type="button" class="position-relative rounded border px-3 py-2" :class="isSelected(tag.id)
            ? 'bg-white text-dark border-dark'
            : 'bg-white text-dark'" @click="toggleTag(tag.id)">
            {{ tag.name }}

            <!--
            <span class="position-absolute translate-middle badge rounded-pill bg-danger top-0">
                {{ tag.products_count }}
            </span>
            -->
        </button>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { useFilterStore } from '@/stores/filterStore'

defineProps({
    tags: {
        type: Array,
        required: true
    }
})

const filter = useFilterStore()

const selectedTags = computed({
    get: () => filter.filterTags,
    set: (val) => filter.setSelectedTags(val)
})

const toggleTag = (id) => {
    if (selectedTags.value.includes(id)) {
        selectedTags.value = selectedTags.value.filter(t => t !== id)
    } else {
        selectedTags.value = [...selectedTags.value, id]
    }
}

const isSelected = (id) => selectedTags.value.includes(id)
</script>
