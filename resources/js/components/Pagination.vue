<template>
    <div v-if="pagination.last_page > 1" class="compact-minimal">
        <div class="pagination-wrapper">
            <!-- Strelica levo -->
            <span v-if="pagination.current_page === 1" class="nav-btn disabled">‹</span>
            <a v-else href="#" class="nav-btn" @click.prevent="goToPage(pagination.current_page - 1)">‹</a>

            <!-- Brojevi -->
            <div class="pages">
                <span v-for="page in computedPages" :key="page.key">
                    <span v-if="page.ellipsis" class="ellipsis">...</span>
                    <span v-else-if="page.number === pagination.current_page" class="page-item active">{{ page.number
                    }}</span>
                    <a v-else href="#" class="page-item" @click.prevent="goToPage(page.number)">{{ page.number }}</a>
                </span>
            </div>

            <!-- Strelica desno -->
            <span v-if="pagination.current_page === pagination.last_page" class="nav-btn disabled">›</span>
            <a v-else href="#" class="nav-btn" @click.prevent="goToPage(pagination.current_page + 1)">›</a>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
const props = defineProps({ pagination: Object });
const emit = defineEmits(['changePage']);

// generiše brojeve stranica sa elipsama
const computedPages = computed(() => {
    const pages = [];
    const total = props.pagination.last_page;
    const current = props.pagination.current_page;

    for (let i = 1; i <= total; i++) {
        if (total <= 7 || i === 1 || i === total || (i >= current - 1 && i <= current + 1)) {
            pages.push({ number: i, ellipsis: false, key: i });
        } else if (pages[pages.length - 1]?.ellipsis !== true) {
            pages.push({ ellipsis: true, key: `e-${i}` });
        }
    }

    return pages;
});

const goToPage = (page) => {
    if (page < 1 || page > props.pagination.last_page) return;
    emit('changePage', page);
};
</script>

<style>
/* Prekopiraj CSS iz tvog Blade paginatora */
.compact-minimal {
    --primary: #555;
    --gray: #d1d5db;
    --dark-gray: #6b7280;
}

.compact-minimal .pagination-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}

.compact-minimal .nav-btn {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    background: white;
    border: 1px solid var(--gray);
    color: var(--dark-gray);
    text-decoration: none;
    transition: all 0.2s;
}

.compact-minimal .nav-btn:hover:not(.disabled) {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.compact-minimal .nav-btn.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    background: #f9fafb;
}

.compact-minimal .pages {
    display: flex;
    align-items: center;
    gap: 4px;
}

.compact-minimal .page-item {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    font-size: 0.875rem;
    text-decoration: none;
    color: var(--dark-gray);
    transition: all 0.2s;
}

.compact-minimal .page-item:hover:not(.active) {
    background: #f3f4f6;
    color: var(--primary);
}

.compact-minimal .page-item.active {
    background: var(--primary);
    color: white;
    font-weight: 600;
}

.compact-minimal .ellipsis {
    color: #9ca3af;
    padding: 0 4px;
    font-weight: bold;
}
</style>
