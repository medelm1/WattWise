import { api } from '@/utils';

async function fetchAll() {
    try {
        return await api.get('/api/settings');

    } catch (error) {
        console.error('Error while attempting to fetch the settings:', error);
        throw error;
    }
}

async function fetch(settingKey) {
    try {
        return await api.get(`/api/settings/${settingKey}`);

    } catch (error) {
        console.error('Error attempting to fetch the setting:', error);
        throw error;
    } 
}

async function edit(payload, settingKey) {
    try {
        return await api.put(`/api/settings/${settingKey}`, payload);

    } catch (error) {
        console.error('Error while attempting to edit the setting:', error);
        throw error;
    }
}

async function editMultiple(payload) {
    try {
        return await api.put(`/api/settings`, payload);

    } catch (error) {
        console.error('Error while attempting to edit the settings:', error);
        throw error;
    }
}

export default {
    fetchAll,
    fetch,
    edit,
    editMultiple
};