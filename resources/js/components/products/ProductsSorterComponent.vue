<template>
    <div class="row">
        <!-- Per page -->
        <div class="col-3 col-md-2">
            <div class="form-floating">
                <select class="form-select" id="perPage" v-model="perPage">
                    <option v-for="option in perPageOptions" :key="option.value" :value="option.value">
                        {{ option.label }}
                    </option>
                </select>
                <label for="perPage">na strani</label>
            </div>
        </div>

        <div class="col-4 col-md-7"></div>

        <!-- Sort by -->
        <div class="col-5 col-md-3">
            <div class="form-floating">
                <select class="form-select" id="sortBy" v-model="sortBy">
                    <option v-for="option in sortOptions" :key="option.value" :value="option.value">
                        {{ option.label }}
                    </option>
                </select>
                <label for="sortBy">razvrsti</label>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';

/* Per page */
const perPageOptions = [
    { value: 40, label: '40' },
    { value: 32, label: '32' },
    { value: 25, label: '24' },
    { value: 10, label: '16' },
    { value: 5, label: '8' },
];

const perPage = ref(32);

/* Sort */
const sortOptions = [
    { value: 'minPrice', label: 'Cena (najprej najnižja)' },
    { value: 'maxPrice', label: 'Cena (najprej najvišja)' },
    { value: 'discount', label: 'Razlika v ceni' },
    { value: '-brand', label: 'Ime izdelka (Z-A)' },
    { value: 'brand', label: 'Ime izdelka (A-Z)' },
];

const sortBy = ref('minPrice');


const emit = defineEmits(['change']);

watch([perPage, sortBy], () => {
    emit('change', {
        perPage: perPage.value,
        sortBy: sortBy.value,
    });
});
</script>
