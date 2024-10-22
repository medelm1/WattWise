<script setup>
import { reactive, watch } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, helpers } from '@vuelidate/validators';
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
        required: helpers. withMessage('Appliance powser is rating is required.', required),
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
    <v-dialog v-model="createApplianceDialogStore.isOpen" max-width="500">
        <v-card title="New Appliance">
            <v-card-text>
                <form>
                    <v-text-field
                        v-model="state.name"
                        :counter="64"
                        :error-messages="v$.name.$errors.map(e => e.$message)"
                        label="Appliance Name"
                        required
                        @blur="v$.name.$touch"
                        @input="v$.name.$touch"
                        class="mb-2"
                    ></v-text-field>
                    <v-text-field
                        v-model="state.powerRating"
                        :error-messages="v$.powerRating.$errors.map(e => e.$message)"
                        label="Power Rating (Watts)"
                        required
                        @blur="v$.powerRating.$touch"
                        @input="v$.powerRating.$touch"
                        class="mb-2"
                    ></v-text-field>
                    <v-text-field
                        v-model="state.usageHours"
                        :error-messages="v$.usageHours.$errors.map(e => e.$message)"
                        label="Usage Hours"
                        required
                        @blur="v$.usageHours.$touch"
                        @input="v$.usageHours.$touch"
                        class="mb-2"
                    ></v-text-field>
                    <v-text-field
                        v-model="state.units"
                        :error-messages="v$.units.$errors.map(e => e.$message)"
                        label="Units"
                        @blur="v$.units.$touch"
                        @input="v$.units.$touch"
                        class="mb-2"
                    ></v-text-field>
                </form>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn 
                    text="Save Changes" 
                    color="primary" 
                    class="me-2"
                    @click="handleSaveChanges"
                ></v-btn>
                <v-btn
                    text="Close"
                    @click="createApplianceDialogStore.close"
                ></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>