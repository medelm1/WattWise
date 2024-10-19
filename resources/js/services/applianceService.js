import { api } from '@/utils';

async function fetchAll() {
    try {
        return await api.get('/api/appliances');

    } catch (error) {
        console.error('Error while attempting to fetch the appliances:', error);
        throw error;
    }
}

async function fetch(applianceID) {
    try {
        return await api.get(`/api/appliances/${applianceID}`);

    } catch (error) {
        console.error('Error attempting to fetch the appliance:', error);
        throw error;
    } 
}

async function create(payload) {
    try {
        return await api.post('/api/appliances', payload);

    } catch (error) {
        console.error('Error while attempting to add new appliance:', error);
        throw error;
    }
}

async function edit(payload, applianceID) {
    try {
        return await api.put(`/api/appliances/${applianceID}`, payload);

    } catch (error) {
        console.error('Error while attempting to edit the appliance:', error);
        throw error;
    }
}

async function remove(applianceID) {
    try {
        return await api.del(`/api/appliances/${applianceID}`);
        
    } catch (error) {
        console.error('Error while attempting to delete the appliance:', error);
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