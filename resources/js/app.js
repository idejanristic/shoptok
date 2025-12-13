import "./bootstrap";

import "bootstrap";

import { createApp } from "vue";
import ProductsContent from "@/components/products/content.vue";

const app = createApp({});

app.component("products-content", ProductsContent);

app.mount("#app");
