import "./bootstrap";

import "bootstrap";

import { createPinia } from "pinia";
import { useFilterStore } from "@/stores/filterStore";

const pinia = createPinia();

import { createApp } from "vue";
import Pagination from "@/components/Pagination.vue";
import ProductsContentComponent from "@/components/products/ProductsContentComponent.vue";
import ProductsListComponent from "@/components/products/ProductsListComponent.vue";
import ProductsListItemComponent from "@/components/products/ProductsListItemComponent.vue";
import ProductsSorterComponent from "@/components/products/ProductsSorterComponent.vue";
import LoaderOverlay from "@/components/LoaderOverlay.vue";
import BrandFilterComponent from "@/components/filters/BrandFilterComponent.vue";
import TagFilterComponent from "@/components/filters/TagFilterComponent.vue";
import ProductsFilterComponent from "./components/products/ProductsFilterComponent.vue";

const app = createApp({
    setup() {
        const filter = useFilterStore();

        return {
            filter,
        };
    },
});

app.component("products-content-component", ProductsContentComponent);
app.component("products-list-component", ProductsListComponent);
app.component("products-list-item-component", ProductsListItemComponent);
app.component("products-sorter-component", ProductsSorterComponent);
app.component("products-filter-component", ProductsFilterComponent);
app.component("pagination-component", Pagination);
app.component("loader-overlay", LoaderOverlay);

app.use(pinia).mount("#app");

const sidebarApp = createApp({
    setup() {
        const filter = useFilterStore();

        return {
            filter,
        };
    },
});

sidebarApp.component("brand-filter-component", BrandFilterComponent);
sidebarApp.component("tag-filter-component", TagFilterComponent);

sidebarApp.use(pinia).mount("#sidebar-app");

const sidebarMobApp = createApp({
    setup() {
        const filter = useFilterStore();

        return {
            filter,
        };
    },
});

sidebarMobApp.component("brand-filter-component", BrandFilterComponent);
sidebarMobApp.component("tag-filter-component", TagFilterComponent);

sidebarMobApp.use(pinia).mount("#sidebar-mob-app");
