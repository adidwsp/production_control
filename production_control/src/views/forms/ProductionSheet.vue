<script setup lang="ts">
import { ref, computed, defineProps, defineEmits } from 'vue';

interface ProductionData {
  id: number;
  product: string;
  quantity: number;
  status: string;
}

// Mendefinisikan props untuk menerima mode: 'edit' atau 'view'
const props = defineProps<{ mode: 'edit' | 'view' }>();
// Emitting event (misalnya untuk menutup dialog)
const emit = defineEmits(['close']);

// Data sample untuk tabel produksi
const productionItems = ref<ProductionData[]>([
  { id: 1, product: 'Product A', quantity: 10, status: 'In Progress' },
  { id: 2, product: 'Product B', quantity: 20, status: 'Complete' },
  { id: 3, product: 'Product C', quantity: 15, status: 'In Progress' },
]);

// State lokal untuk input form
const productionId = ref('');
const productionDate = ref('');

// Computed property untuk menentukan apakah mode view
const isViewMode = computed(() => props.mode === 'view');

// Method untuk menambahkan data baru ke tabel
const addItem = () => {
  productionItems.value.push({
    id: productionItems.value.length + 1,
    product: 'New Product',
    quantity: 0,
    status: 'In Progress'
  });
};

// Method untuk menyimpan data (contoh implementasi)
const save = () => {
  console.log('Saved Production Sheet:', {
    productionId: productionId.value,
    productionDate: productionDate.value,
    items: productionItems.value,
  });
  // Lakukan logic penyimpanan data sesuai kebutuhan
};
</script>

<template>
  <v-card>
    <v-card-title>
      <span class="headline">Production Sheet - {{ isViewMode ? 'View' : 'Edit' }}</span>
    </v-card-title>
    <v-card-text>
      <!-- Form untuk input data produksi -->
      <v-form>
        <v-container>
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field 
                label="Production ID" 
                v-model="productionId" 
                :disabled="isViewMode" />
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field 
                label="Production Date" 
                v-model="productionDate" 
                :disabled="isViewMode" />
            </v-col>
          </v-row>
        </v-container>
      </v-form>

      <!-- Tabel untuk data produksi -->
      <v-data-table
        :headers="[
          { title: 'ID', value: 'id' },
          { title: 'Product', value: 'product' },
          { title: 'Quantity', value: 'quantity' },
          { title: 'Status', value: 'status' }
        ]"
        :items="productionItems"
        class="mt-4"
      >
        <!-- Toolbar pada bagian atas tabel -->
        <template #top>
          <v-toolbar flat>
            <v-toolbar-title>Production Details</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <!-- Tampilkan tombol tambah jika dalam mode edit -->
            <v-btn v-if="!isViewMode" color="primary" @click="addItem">Add Item</v-btn>
          </v-toolbar>
        </template>

        <!-- Slot untuk menampilkan status dengan chip -->
        <template #item.status="{ item }">
          <v-chip :color="item.status === 'Complete' ? 'green' : 'blue'" dark>
            {{ item.status }}
          </v-chip>
        </template>
      </v-data-table>
    </v-card-text>

    <!-- Footer Dialog -->
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn variant="text" color="primary" @click="$emit('close')">Close</v-btn>
      <v-btn v-if="!isViewMode" color="primary" @click="save">Save</v-btn>
    </v-card-actions>
  </v-card>
</template>

<style scoped>
.mt-4 {
  margin-top: 16px;
}
</style>
