<template>
    <div class="account-wrapper">
        <div class="account" @click.stop="open = !open">
            <i class="fa fa-user"></i>
            <span>حسابي</span>
            <i class="fa fa-chevron-down"></i>
        </div>

        <div class="dropdown-menu" :class="{ active: open }">
            <a :href="loginUrl" class="dropdown-item">تسجيل الدخول</a>
            <a :href="registerUrl" class="dropdown-item">تسجيل عميل جديد</a>
        </div>
    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';

defineProps({
    loginUrl: {
        type: String,
        required: true,
    },
    registerUrl: {
        type: String,
        required: true,
    },
});

const open = ref(false);

function closeMenu() {
    open.value = false;
}

onMounted(() => {
    document.addEventListener('click', closeMenu);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', closeMenu);
});
</script>