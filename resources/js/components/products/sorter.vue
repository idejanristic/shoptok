<template>
    <div class="row">
        <div class="col-3 col-md-2">
            <div class="form-floating">
                <select class="form-select" id="perPage">
                    <option value="40">40</option>
                    <option value="32" selected>32</option>
                    <option value="25">24</option>
                    <option value="10">16</option>
                    <option value="5">8</option>
                </select>
                <label for="floatingSelect">na strani</label>
            </div>
        </div>
        <div class="col-4 col-md-7"></div>
        <div class="col-5 col-md-3">
            <div class="form-floating">
                <select class="form-select" id="sortBy">
                    <option value="minPrice" selected>
                        Cena (najprej najnižja)
                    </option>
                    <option value="maxPrice">
                        Cena (najprej najvišja)
                    </option>
                    <option value="discount">
                        Razlika v ceni
                    </option>
                    <option value="-brand">
                        Ime izdelka (Z-A)
                    </option>
                    <option value="brand">
                        Ime izdelka (A-Z)
                    </option>
                </select>
                <label for="floatingSelect">razvrsti</label>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>
