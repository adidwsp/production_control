<script setup lang="ts">
import { ref, computed, defineProps, defineEmits } from 'vue';
import { AllCommunityModule, ModuleRegistry } from 'ag-grid-community';
import { AgGridVue } from "ag-grid-vue3";

// Register all Community features
ModuleRegistry.registerModules([AllCommunityModule]);

interface ProductionData {
  no: number;
  partNo: string;
  jobNo: string;
  status: string;
  plan: number;
  actual: number;
  remarks?: string;
}

// Mendefinisikan props untuk menerima mode: 'edit' atau 'view'
const props = defineProps<{ mode: 'edit' | 'view' }>();
// Emitting event (misalnya untuk menutup dialog)
const emit = defineEmits(['close']);

// Data sample untuk tabel produksi
const rowData = ref<ProductionData[]>([
  { no: 1, partNo: 'Product A', jobNo: 'P001', status: 'FP', plan: 10, actual: 10 },
  { no: 2, partNo: 'Product B', jobNo: 'P001', status: 'FP', plan: 20, actual: 10, remarks: 'Problem machine' },
  { no: 3, partNo: 'Product C', jobNo: 'P001', status: 'FP', plan: 10, actual: 30 },
  { no: 4, partNo: 'Product D', jobNo: 'P001', status: 'FP', plan: 50, actual: 50 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
  { no: 5, partNo: 'Product F', jobNo: 'P001', status: 'WIP', plan: 120, actual: 100 },
]);

// Default column definition: tidak bisa di-resize secara default
const defaultColDef = {
  resizable: false,
  cellStyle: { textAlign: 'center' }
};

// Definisi kolom (bisa menimpa jika perlu)
const colDefs = ref([
  { field: "no", flex: 1},
  { field: "partNo", filter: true, flex: 3 },
  { field: "jobNo", filter: true, flex: 3 },
  { 
    field: "status",
    editable: true,
    cellEditor: 'agSelectCellEditor',
    flex: 2,
    cellEditorParams: {
      values: ['FP', 'WIP'],
    },
  },
  { field: "plan", flex: 3 },
  { field: "actual", editable: true, flex: 2 },
  { field: "remarks", editable: true, flex: 4 },
]);

// Computed property untuk menentukan apakah mode view
const isViewMode = computed(() => props.mode === 'view');
</script>

<template>
  <v-card>
    <v-card-title class="d-flex justify-space-between align-center">
        <span v-if="mode === 'edit'">Edit Production Sheet</span>
        <span v-else-if="mode === 'view'">View Production Sheet</span>
        <v-spacer></v-spacer>
      </v-card-title>
    <!-- AG Grid dengan defaultColDef -->
    <AgGridVue
      :rowData="rowData"
      :columnDefs="colDefs"
      :defaultColDef="defaultColDef"
      style="height: 500px;">
    </AgGridVue>
  </v-card>
</template>

<style scoped>
.mt-4 {
  margin-top: 16px;
}
</style>
