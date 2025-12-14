<template>
    <div class="card">
        <div class="card-body position-relative">

            <!-- Image wrapper -->
            <div class="position-relative mb-2">
                <img :src="product.image" :alt="product.name" class="img-thumbnail" />

                <!-- Tags badges (top-left) -->
                <div v-if="product.tags && product.tags.length > 0" class="position-absolute top-0 d-flex flex-wrap">
                    <span v-for="tag in product.tags" :key="tag.id"
                        class="badge bg-danger bg-opacity-25 text-danger border border-danger me-1 mb-1 p-2">
                        {{ tag.name }}
                    </span>
                </div>

                <!-- Discount badge (top-right) -->
                <span v-if="product.discount && product.discount > 0"
                    class="badge bg-success bg-opacity-25 text-success border border-success me-1 mb-1 position-absolute top-0 end-0 p-2">
                    - {{ product.discount }} %
                </span>
            </div>

            <!-- Product info -->
            <p v-if="product.brand" class="mb-1"><b>{{ product.brand.name }}</b></p>
            <p class="text-multiline-ellipsis">{{ product.name }}</p>
            <b>{{ product.price }} €</b>
        </div>
    </div>
</template>



<script setup>
defineProps({
    product: {
        type: Object,
        required: true
    }
});
</script>
