<script setup>
import { reactive } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, helpers } from '@vuelidate/validators';
import { notification } from '@/utils';
import { deviceService } from '@/services';

let state = initializeState();

const rules = {
    name: {
        required: helpers.withMessage('Device name is required.', required),
    },
    powerRating: {
        required: helpers. withMessage('Device powser is rating is required.', required),
    },
    usageHours: {
        required: helpers.withMessage('Device usage hours is required.', required),
    }
};

const v$ = useVuelidate(rules, state);

function initializeState() {
    return reactive({
        name: '', 
        powerRating: '',
        usageHours: '',
    });
}

async function handleSave() {
    try {
        await deviceService.create({
            name: state.name,
            powerRating: parseInt(state.powerRating),
            usageHours: parseInt(state.usageHours),
        });

        notification('Device added successfully!', 'success');
    } catch (error) {
        console.log(error);
    }
}

function handleClose(isActive) {
    v$.value.$reset();
    isActive.value = false;
    state =  initializeState();
}

</script>
<template>
    <v-dialog max-width="500">
        <template v-slot:activator="{ props: activatorProps }">
            <v-btn
                v-bind="activatorProps"
                color="surface-variant"
                text="New Device"
                variant="flat"
            ></v-btn>
        </template>
        <template v-slot:default="{ isActive }">
            <v-card title="New device">
                <v-card-text>
                    <form>
                        <v-text-field
                            v-model="state.name"
                            :counter="64"
                            :error-messages="v$.name.$errors.map(e => e.$message)"
                            label="Device Name"
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
                    </form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        text="Validate"
                        color="primary"
                        @click="handleSave"
                        class="me-2"
                    ></v-btn>
                    <v-btn
                        text="Close"
                        @click="() => handleClose(isActive)"
                    ></v-btn>
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>
</template>