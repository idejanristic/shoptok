import { defineStore } from "pinia";
import { useStorage } from "@vueuse/core";

export const useFilterStore = defineStore("filter", {
    state: () => ({
        filterBrands: useStorage("filter_brands", []),
        filterTags: useStorage("filter_tags", []),
    }),

    actions: {
        setSelectedBrands(brands) {
            this.filterBrands = brands;
        },

        setSelectedTags(tags) {
            this.filterTags = tags;
        },

        removeBrand(id) {
            this.filterBrands = this.filterBrands.filter((b) => b !== id);
        },

        removeTag(id) {
            this.filterTags = this.filterTags.filter((t) => t !== id);
        },

        clearAll() {
            this.filterBrands = [];
            this.filterTags = [];
        },
    },
});
