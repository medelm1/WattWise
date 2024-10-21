<script setup>
import { reactive, watch } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, numeric, helpers } from '@vuelidate/validators';
import { settingsService } from '@/services';
import { useSettingsDialogStore } from '@/stores';
import { notification } from '@/utils';
import currencies from '@/data/currencies';

const settingsDialogStore = useSettingsDialogStore();

const state = reactive({
    currency: "",
    energyRate: "",
});

const rules = {
    currency: {
        required: helpers.withMessage('Currency is required.', required),
    },
    energyRate: {
        required: helpers.withMessage('Energy rate is required.', required),
        numeric: helpers.withMessage('Units must be a numeric value.', numeric),
    }
};

const v$ = useVuelidate(rules, state);

async function handleSaveChanges()
{
    const isValid = await v$.value.$validate();

    if (!isValid) return;
    
    try {
        // Continue for here

    } catch (error) {
        notification.error(error.message);
    }
}

watch(
    () => settingsDialogStore.isOpen,
    async (isOpen) => {
        if (!isOpen) return;

        try {
            const settings = await settingsService.fetchAll();

            settings.forEach(setting => {
                switch (setting.key) {
                    case 'currency':
                        state.currency = setting.value.code;
                        break;
                    case 'energy_rate':
                        state.energyRate = setting.value;
                        break;
                    default:
                        console.warn(`Unhandled setting key: ${setting.key}`);
                }
            });
        } catch (error) {
            notification.error('Failed to fetch settings: ' + error.message);
        }
    }
);


</script>
<template>
    <v-dialog v-model="settingsDialogStore.isOpen" max-width="500">
        <v-card title="Settings">
            <v-card-text>
                <form>
                    <v-select
                        v-model="state.currency"
                        label="Currency"
                        :items="currencies" 
                    ></v-select>
                    <v-text-field
                        v-model="state.energyRate"
                        :error-messages="v$.energyRate.$errors.map(e => e.$message)"
                        label="Energy rating"
                        required
                        @blur="v$.energyRate.$touch"
                        @input="v$.energyRate.$touch"
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
                    @click="settingsDialogStore.close"
                ></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>