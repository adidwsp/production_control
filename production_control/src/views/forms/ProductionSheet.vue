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
  { no: 2, partNo: 'Product B', jobNo: 'P002', status: 'FP', plan: 20, actual: 10, remarks: 'Problem machine' },
  { no: 3, partNo: 'Product C', jobNo: 'P003', status: 'FP', plan: 10, actual: 30 },
  { no: 4, partNo: 'Product D', jobNo: 'P003', status: 'FP', plan: 50, actual: 50 },
  { no: 5, partNo: 'Product F', jobNo: 'P004', status: 'WIP', plan: 120, actual: 100 },
]);

// Default column definition: tidak bisa di-resize secara default
const defaultColDef = {
  resizable: false,
  cellStyle: { textAlign: 'center'},
};

// Definisi kolom (bisa menimpa jika perlu)
const colDefs = ref([
  { field: "no", maxWidth: 60, flex: 1 },
  { field: "partNo", flex: 3 },
  { field: "jobNo", flex: 3 },
  { 
    field: "status",
    flex: 1 ,
    editable: true,
    cellEditor: 'agSelectCellEditor',
    cellEditorParams: {
      values: ['FP', 'WIP'],
    },
  },
  { field: "plan", maxWidth: 100, flex: 1  },
  { field: "actual", maxWidth: 100 , editable: true, flex: 1  },
  { field: "remarks", editable: true, flex: 4  },
]);

// Computed property untuk menentukan apakah mode view
const isViewMode = computed(() => props.mode === 'view');
</script>

<template>
  <v-card>
    <!-- AG Grid dengan defaultColDef -->
    <AgGridVue
      :rowData="rowData"
      :columnDefs="colDefs"
      :defaultColDef="defaultColDef"
      style="height: 500px">
    </AgGridVue>
  </v-card>
</template>

<style scoped>
.mt-4 {
  margin-top: 16px;
}
</style>
