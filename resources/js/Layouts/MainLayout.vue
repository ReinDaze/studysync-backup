<script setup lang="js">
import HeaderContent from '@/Components/HeaderContent.vue';
import FooterContent from '@/Components/FooterContent.vue';
</script>

<template>
    <HeaderContent />
    <main>
        <slot></slot>
    </main>
    <FooterContent/>
</template>