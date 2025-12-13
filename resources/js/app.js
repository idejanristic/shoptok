import "./bootstrap";

import "bootstrap";

import { createApp } from "vue";
import Pagination from "@/components/Pagination.vue";
import ProductsContentComponent from "@/components/products/ProductsContentComponent.vue";
import ProductsListComponent from "@/components/products/ProductsListComponent.vue";
import ProductsListItemComponent from "@/components/products/ProductsListItemComponent.vue";
import ProductsSorterComponent from "@/components/products/ProductsSorterComponent.vue";
import LoaderOverlay from "./components/LoaderOverlay.vue";

const app = createApp({});

app.component("products-content-component", ProductsContentComponent);
app.component("products-list-component", ProductsListComponent);
app.component("products-list-item-component", ProductsListItemComponent);
app.component("products-sorter-component", ProductsSorterComponent);
app.component("pagination-component", Pagination);
app.component("loader-overlay", LoaderOverlay);

app.mount("#app");
