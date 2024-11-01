<script setup>
import { ref } from 'vue';
import Button from 'primevue/button';
import Menu from 'primevue/menu';

const emit = defineEmits(['edit', 'delete']);

const menu = ref();
const items = ref([
    {
        label: 'Options',
        items: [
            {
                label: 'Edit',
                icon: 'pi pi-pencil',
                command: () => emit('edit'),
            },
            {
                label: 'Delete',
                icon: 'pi pi-trash',
                command: () => emit('delete'),
            }
        ]
    }
]);

const toggle = (event) => {
    menu.value.toggle(event);
};

</script>
<template>
    <div class="card flex justify-center">
        <Button type="button" icon="pi pi-ellipsis-v" @click="toggle" aria-haspopup="true" aria-controls="overlay_menu" outlined severity="secondary"></Button>
        <Menu ref="menu" :model="items" :popup="true">
            <template #item="{ item, props }">
                <a class="flex items-center text-sm" v-bind="props.action">
                    <span :class="item.icon"></span>
                    <span>{{ item.label }}</span>
                </a>
            </template>
        </Menu>
    </div>
</template>