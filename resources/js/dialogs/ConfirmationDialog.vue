<script setup>
import { useConfirmationDialogStore } from '@/stores';

const confrimationDialogStore = useConfirmationDialogStore();

function handleConfirm()
{
    confrimationDialogStore.callback();
    confrimationDialogStore.close();
}

</script>
<template>
    <v-dialog v-model="confrimationDialogStore.isOpen" max-width="500">
        <v-card title="Confrimation">
            <v-card-text>
                Are you sure you want to proceed?
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn 
                    text="Confirm" 
                    color="primary" 
                    class="me-2"
                    @click="handleConfirm"
                ></v-btn>
                <v-btn
                    text="Cancel"
                    @click="confrimationDialogStore.close"
                ></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>