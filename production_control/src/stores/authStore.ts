import { defineStore } from 'pinia';

const API_BASE_URL = 'http://localhost:8080/api'; // Sesuaikan dengan base URL backend Anda

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as { id: number; username: string; firstName: string; lastName: string; accessToken: string } | null, // Asumsi nama field token adalah accessToken
    loggedIn: false,
    loading: false,
    error: null,
  }),

  getters: {
    isAuthenticated: (state) => state.loggedIn,
    currentUser: (state) => state.user,
    authLoading: (state) => state.loading,
    authError: (state) => state.error,
  },

  actions: {
    async login(username: string, password: string) {
      this.loading = true;
      this.error = null;
      try {
        const response = await fetch(`${API_BASE_URL}/login`, { // Sesuaikan endpoint login backend Anda
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ username, password }),
        });
        const data = await response.json();

        if (!response.ok) {
          this.error = data.message || 'Login gagal.';
          this.loggedIn = false;
          this.user = null;
          throw new Error(this.error || 'Unknown error occurred.');
        }

        this.user = data.user; // Asumsi backend mengembalikan objek user
        this.loggedIn = true;
        localStorage.setItem('accessToken', data.accessToken); // Simpan token dari backend asli
      } catch (error: any) {
        this.error = error.message || 'Terjadi kesalahan saat login.';
        this.loggedIn = false;
        this.user = null;
      } finally {
        this.loading = false;
      }
    },

    logout() {
      this.user = null;
      this.loggedIn = false;
      localStorage.removeItem('accessToken');
    },

    // Action untuk memeriksa token yang ada di localStorage (opsional)
    async checkAuth() {
      const token = localStorage.getItem('accessToken');
      if (token) {
        // Kirim permintaan ke backend untuk memvalidasi token
        try {
          const response = await fetch(`${API_BASE_URL}/partlist`, { // Contoh endpoint untuk mendapatkan info user berdasarkan token
            headers: { 'Authorization': `Bearer ${token}` },
          });
          if (response.ok) {
            const data = await response.json();
            this.user = data.user;
            this.loggedIn = true;
          } else {
            this.logout(); // Token tidak valid, logout
          }
        } catch (error) {
          console.error('Error checking auth:', error);
          this.logout();
        }
      }
    },
  },
});