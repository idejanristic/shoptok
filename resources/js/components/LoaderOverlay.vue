<template>
    <div v-if="show" class="overlay">
        <div class="dots" :style="{
            fontSize: size + 'px',
            color: color
        }">
            <span class="dot dot-1">•</span>
            <span class="dot dot-2">•</span>
            <span class="dot dot-3">•</span>
        </div>
    </div>
</template>

<script setup>
defineProps({
    show: {
        type: Boolean,
        default: false
    },
    size: {
        type: Number,
        default: 48
    },
    color: {
        type: String,
        default: '#555'
    }
});
</script>

<style scoped>
/* Overlay */
.overlay {
    position: fixed;
    inset: 0;
    background: rgba(255, 255, 255, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

/* Tačke */
.dots {
    display: flex;
    gap: 10px;
    font-weight: bold;
}

/* Animacija */
.dot {
    animation: pulse 1.4s infinite ease-in-out;
}

.dot-2 {
    animation-delay: 0.2s;
}

.dot-3 {
    animation-delay: 0.4s;
}

@keyframes pulse {
    0% {
        transform: scale(0.6);
        opacity: 0.3;
    }

    50% {
        transform: scale(1.2);
        opacity: 1;
    }

    100% {
        transform: scale(0.6);
        opacity: 0.3;
    }
}
</style>
