import { api } from '@/utils';

async function fetchAll() {
    try {
        return await api.get('/api/devices');

    } catch (error) {
        console.error('Error while attempting to fetch the devices:', error);
        throw error;
    }
}

async function fetch(deviceID) {
    try {
        const response = await api.get(`/api/devices/${deviceID}`);
    } catch (error) {
        console.error('Error attempting to fetch the device:', error);
        throw error;
    } 
}

async function create(payload) {
    try {
        const response = await api.post('/api/devices', payload);

        console.log(response);
        return null;

    } catch (error) {
        console.error('Error while attempting to add new device:', error);
        throw error;
    }
}

async function edit(payload, deviceID) {
    try {
        const response = await api.put(`/api/devices/${deviceID}`, payload);
    } catch (error) {
        console.error('Error while attempting to edit the device:', error);
        throw error;
    }
}

async function remove(deviceID) {
    try {
        const response = await api.del(`/api/devices/${deviceID}`);
    } catch (error) {
        console.error('Error while attempting to delete the device:', error);
        throw error;
    }
}

export default {
    fetchAll,
    fetch,
    create,
    edit,
    remove,
};