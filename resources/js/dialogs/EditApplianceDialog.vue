<script setup>
import { reactive, watch } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, helpers } from '@vuelidate/validators';
import { applianceService } from '@/services';
import { useApplianceStore, useEditApplianceDialogStore } from '@/stores';
import { notification } from '@/utils';

const applianceStore = useApplianceStore();
const editApplianceDialogStore = useEditApplianceDialogStore();

const state = reactive({
    name: "",
    powerRating: "",
    usageHours: "",
    units: 0,
});

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

async function handleSaveChanges() 
{
    const isValid = await v$.value.$validate();

    if (isValid) {
        try {
            const updatedAppliance = await applianceService.edit({
                name: state.name,
                powerRating: state.powerRating,
                usageHours: state.usageHours,
                units: state.units,
            }, editApplianceDialogStore.selectedAppliance.id);

            applianceStore.updateAppliance(updatedAppliance);

            editApplianceDialogStore.close();

            notification.success('Appliance updated succesfully!');

        } catch (error) {
            notification.error(error.message);
        }
    }
}

watch(
    () => editApplianceDialogStore.selectedAppliance, 
    (newVal) => {
        if (newVal) {
            state.name = newVal.name;
            state.powerRating = newVal.powerRating;
            state.usageHours = newVal.usageHours;
            state.units = newVal.units;
        }
    }
);

</script>
<template>
    <v-dialog v-model="editApplianceDialogStore.isOpen" max-width="500">
        <v-card title="Edit Appliance">
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
                    @click="editApplianceDialogStore.close"
                ></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>