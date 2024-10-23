<script setup>
import { ref } from 'vue';
import { useTabStore } from "@/stores/tabStore";
import Settings from "@/views/Settings.vue";
import Estimator from "@/views/Estimator.vue";
import Button from "primevue/button";
import InputText from 'primevue/inputtext';

const tabStore = useTabStore();

const text = ref('');

</script>

<template>
    <button>hi</button>
    <InputText v-model="text" />
    <Button icon="pi pi-user" label="Save" />
    <span class="text-red-200">{{ text }}</span>
</template>
