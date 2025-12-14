<template>
    <div class="row">
        <div class="col-12 col-md-6" v-if="brands && brands.length">
            <div class="filter-title mb-1">
                Proizvajalec:
            </div>
            <a v-for="brand in brands" :key="brand.id" href="#" class="btn bg-white text-dark border-dark mb-1 me-1"
                role="button" aria-pressed="true" @click.stop.prevent="removeBrand(brand.id)">
                {{ brand.name }}
                <span class="ms-2 close-btn text-muted" role="button" aria-label="Remove">
                    ✕
                </span>
            </a>
        </div>

        <div class="col-12 col-md-6" v-if="tags && tags.length">
            <div class="filter-title mb-1">
                Tagovi
            </div>
            <a v-for="tag in tags" :key="tag.id" href="#" class="btn bg-white text-dark border-dark mb-1 me-1"
                role="button" aria-pressed="true" @click.stop.prevent="removeTag(tag.id)">
                {{ tag.name }}
                <span class="ms-2 close-btn text-muted" role="button" aria-label="Remove">
                    ✕
                </span>
            </a>
        </div>

        <div class="col-12" v-if="(tags && tags.length) || (brands && brands.length)">
            <a class="btn bg-danger text-white mb-1 me-1" role="button" aria-pressed="true"
                @click.stop.prevent="clearAll">
                Odstrani vse
            </a>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    brands: {
        type: Object,
        required: true
    },
    tags: {
        type: Object,
        required: true
    }
});

const emit = defineEmits([
    'remove-brand',
    'remove-tag'
]);

const removeBrand = (id) => {
    emit('remove-brand', id)
}

const removeTag = (id) => {
    emit('remove-tag', id)
}

const clearAll = () => {
    emit('clear-all');
}

</script>
