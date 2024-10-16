import { defineStore } from 'pinia';
import actions from './actions';

export const useTabStore = defineStore('tabStore', {
    state: () => ({
        activeTab: null,
    }),
    actions,
});