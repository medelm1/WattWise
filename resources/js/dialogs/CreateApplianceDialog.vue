<script setup>
import { reactive, watch } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, helpers } from '@vuelidate/validators';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Message from 'primevue/message';
import { applianceService } from '@/services';
import { useApplianceStore, useCreateApplianceDialogStore } from '@/stores';
import { notification } from '@/utils';

const applianceStore = useApplianceStore();
const createApplianceDialogStore = useCreateApplianceDialogStore();

let state = initializeState();

const rules = {
    name: {
        required: helpers.withMessage('Appliance name is required.', required),
    },
    powerRating: {
        required: helpers. withMessage('Appliance power rating is required.', required),
    },
    usageHours: {
        required: helpers.withMessage('Appliance usage hours is required.', required),
    },
    units: {
        numeric: helpers.withMessage('Units must be a numeric value.', numeric),
    }
};

const v$ = useVuelidate(rules, state);

async function handleSaveChanges() {
    const isValid = await v$.value.$validate();

    if (isValid) {
        try {
            applianceStore.addAppliance(
                await applianceService.create({
                    name: state.name,
                    powerRating: state.powerRating,
                    usageHours: state.usageHours,
                    units: state.units,
                })
            );

            createApplianceDialogStore.close();
            
            notification.success('Appliance added successfully!');

        } catch (error) {
            notification.error(error.message);
        }
    }
}

function initializeState() {
    return reactive({
        name: '', 
        powerRating: '',
        usageHours: '',
        units: 1,
    });
}

watch(
    () => createApplianceDialogStore.isOpen,
    (newVal) => {
        if (!newVal) {
            state = initializeState();
            v$.value.$reset();
        }
    }
);

</script>
<template>
    <Dialog v-model:visible="createApplianceDialogStore.isOpen" modal header="Settings" :style="{ width: '25rem' }">
        <template #header>
            New Appliance
        </template>
        <div class="flex flex-col gap-2 mb-4">
            <label for="name" class="font-semibold">Appliance Name</label>
            <InputText v-model="state.name" :invalid="v$.name.$error" id="name" class="flex-auto" aria-autocomplete="off"></InputText>
            <Message v-if="v$.name.$error" severity="error">
                <span class="text-sm">{{ v$.name.$errors[0]?.$message }}</span>
            </Message>
        </div>
        <div class="flex flex-col gap-2 mb-4">
            <label for="powerRating" class="font-semibold">Power Rating (Watts)</label>
            <InputText v-model="state.powerRating" :invalid="v$.powerRating.$error" id="powerRating" class="flex-auto" aria-autocomplete="off"></InputText>
            <Message v-if="v$.powerRating.$error" severity="error">
                <span class="text-sm">{{ v$.powerRating.$errors[0]?.$message }}</span>
            </Message>
        </div>
        <div class="flex flex-col gap-2 mb-4">
            <label for="usageHours" class="font-semibold">Usage Hours</label>
            <InputText v-model="state.usageHours" :invalid="v$.usageHours.$error" id="usageHours" class="flex-auto" aria-autocomplete="off"></InputText>
            <Message v-if="v$.usageHours.$error" severity="error">
                <span class="text-sm">{{ v$.usageHours.$errors[0]?.$message }}</span>
            </Message>
        </div>
        <div class="flex flex-col gap-2 mb-4">
            <label for="units" class="font-semibold">Units</label>
            <InputText v-model="state.units" :invalid="v$.units.$error" id="units" class="flex-auto" aria-autocomplete="off"></InputText>
            <Message v-if="v$.units.$error" severity="error">
                <span class="text-sm">{{ v$.units.$errors[0]?.$message }}</span>
            </Message>
        </div>
        <template #footer>
            <Button label="Cancel" text severity="secondary" @click="createApplianceDialogStore.close"></Button>
            <Button label="Save" outlined severity="secondary" @click="handleSaveChanges"></Button>
        </template>
    </Dialog>
</template>