import { defineStore } from 'pinia';

export const useEditApplianceDialogStore = defineStore('editApplianceDialog', {
    state: () => ({
        isOpen: false,
        selectedAppliance: null, 
    }),
    actions: {
        open(appliance) {
            this.isOpen = true;
            this.selectedAppliance = appliance;
        },
        close() {
            this.isOpen = false;
            this.selectedAppliance = null;
        }
    },
});