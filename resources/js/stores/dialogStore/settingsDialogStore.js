import { defineStore } from "pinia";

export const useSettingsDialogStore = defineStore('settingsDialog', {
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