<template>
    <div>
        <div class="row">
            <div v-for="product in products" :key="product.id" class="col-6 col-md-4 col-lg-3 p-2">
                <products-list-item-component :product="product" />
            </div>
        </div>


    </div>
</template>


<script setup>
defineProps({
    products: {
        type: Array,
        required: true
    }
});
</script>
