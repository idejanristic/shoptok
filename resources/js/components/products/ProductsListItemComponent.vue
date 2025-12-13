<template>
    <div class="card">
        <div class="card-body">
            <img :src="product.image" :alt="product.name" class="img-thumbnail mb-2" />
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
