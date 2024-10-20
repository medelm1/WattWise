import { defineStore } from "pinia";

export const useCreateApplianceDialogStore = defineStore('createApplianceDialog', {
    state: () => ({
        isOpen: false,
    }),
    actions: {
        open() {
            this.isOpen = true;
        },
        close() {
            this.isOpen = false;
        }
    }
});