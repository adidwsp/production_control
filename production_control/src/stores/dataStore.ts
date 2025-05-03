import { defineStore } from 'pinia';
import axios from 'axios';

const API_BASE_URL = 'http://localhost:8080/api';

export const useDataStore = defineStore('data', {
  state: () => ({
    items: [] as any[],
    loading: false,
    error: null as string | null,
  }),

  getters: {
    allItems: (state) => state.items,
    isLoading: (state) => state.loading,
    errorMessage: (state) => state.error,
  },

  actions: {
    async fetchItems(endpoint: string) {
      this.loading = true;
      this.error = null;
      try {
        const { data } = await axios.get(`${API_BASE_URL}/${endpoint}`);
        this.items = data;
      } catch (err: any) {
        this.error = err.message || 'Terjadi kesalahan saat mengambil data.';
      } finally {
        this.loading = false;
      }
    },

    async createItem(endpoint: string, payload: any) {
      this.loading = true;
      this.error = null;
      try {
        const { data } = await axios.post(`${API_BASE_URL}/${endpoint}`, payload);
        return data;
      } catch (err: any) {
        this.error = err.message || 'Terjadi kesalahan saat membuat data.';
        throw err;
      } finally {
        this.loading = false;
      }
    },

    async updateItem(endpoint: string, payload: any) {
      this.loading = true;
      this.error = null;
      try {
        const { data } = await axios.put(`${API_BASE_URL}/${endpoint}`, payload);
        return data;
      } catch (err: any) {
        this.error = err.message || 'Terjadi kesalahan saat update data.';
        throw err;
      } finally {
        this.loading = false;
      }
    },

    async deleteItem(endpoint: string) {
      this.loading = true;
      this.error = null;
      try {
        await axios.delete(`${API_BASE_URL}/${endpoint}`);
      } catch (err: any) {
        this.error = err.message || 'Terjadi kesalahan saat menghapus data.';
        throw err;
      } finally {
        this.loading = false;
      }
    },
  },
});
