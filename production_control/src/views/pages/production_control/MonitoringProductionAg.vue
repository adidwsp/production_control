<template>
  <div style="width: 100%; height: auto;">
    <ag-grid-vue
      style="height: auto"
      :columnDefs="columnDefs"
      :rowData="rowData"
      :defaultColDef="defaultColDef"
      :domLayout="'autoHeight'"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { AgGridVue } from 'ag-grid-vue3'

const dates = Array.from({ length: 31 }, (_, i) => `${i + 1}`)

const columnDefs = ref([
  {
    headerName: 'NO',
    field: 'no',
    width: 60,
    pinned: 'left',
    rowSpan: rowSpanFunc,
    cellClassRules: { 'cell-span': 'value !== ""' }
  },
  {
    headerName: 'PART NO',
    field: 'part_no',
    width: 130,
    pinned: 'left',
    rowSpan: rowSpanFunc,
    cellClassRules: { 'cell-span': 'value !== ""' }
  },
  {
    headerName: 'JOB NO',
    field: 'job_no',
    width: 130,
    pinned: 'left',
    rowSpan: rowSpanFunc,
    cellClassRules: { 'cell-span': 'value !== ""' }
  },
  {
    headerName: 'MODEL',
    field: 'model',
    width: 80,
    pinned: 'left',
    rowSpan: rowSpanFunc,
    cellClassRules: { 'cell-span': 'value !== ""' }
  },
  {
    headerName: 'LINE',
    field: 'line',
    width: 100,
    pinned: 'left',
    rowSpan: rowSpanFunc,
    cellClassRules: { 'cell-span': 'value !== ""' }
  },
  {
    headerName: 'DESC.',
    field: 'desc',
    width: 70,
    pinned: 'left'
  },

  // Kolom tanggal
  ...dates.flatMap(date => ({
    headerName: date,
    children: [
      {
        headerName: 'D',
        field: `${date}_d`,
        width: 60,
        valueFormatter: params => formatIfPercent(params)
      },
      {
        headerName: 'N',
        field: `${date}_n`,
        width: 60,
        valueFormatter: params => formatIfPercent(params)
      }
    ]
  })),

  { headerName: 'TOTAL PLAN', field: 'total_plan', width: 110 },
  { headerName: 'TOTAL ACTUAL', field: 'total_actual', width: 120 },
  {
    headerName: 'ACHIEVEMENT',
    field: 'achievement',
    width: 120,
    valueFormatter: params =>
      params.data.desc === '%' && params.value !== '' ? `${params.value}%` : ''
  }
])

const defaultColDef = {
  resizable: true,
  sortable: false
}

// Row span function: gabungkan setiap 3 baris
function rowSpanFunc(params) {
  return params.data?.desc === 'PLAN' ? 3 : 1
}

// Formatter hanya untuk baris '%'
function formatIfPercent(params) {
  if (params.data?.desc === '%') return params.value
  return typeof params.value === 'number' ? params.value : ''
}

// Generate harian (dummy)
function generateDateFields(values = [], isActual = false) {
  const fields = {}
  dates.forEach((date, i) => {
    const val = values[i] ?? 0
    fields[`${date}_d`] = val
    fields[`${date}_n`] = val
  })
  return fields
}

function generatePercentFields(values = []) {
  const fields = {}
  dates.forEach((date, i) => {
    const val = values[i] ?? '0%'
    fields[`${date}_d`] = typeof val === 'number' ? `${val}%` : val
    fields[`${date}_n`] = typeof val === 'number' ? `${val}%` : val
  })
  return fields
}

// Dummy data (3 baris per part)
const rowData = ref([
  {
    no: 1, part_no: '65111-1Y000', job_no: '65111-1Y000', model: 'SU2ID', line: 'SA HMMI', desc: 'PLAN',
    ...generateDateFields([100, 100, 120, 120, 120, 120, 100, 100, 0, 0]),
    total_plan: 1080, total_actual: '', achievement: ''
  },
  {
    no: '', part_no: '', job_no: '', model: '', line: '', desc: 'ACT.',
    ...generateDateFields([100, 80, 0, 0, 0, 0, 0, 0, 0, 0]),
    total_plan: '', total_actual: 180, achievement: ''
  },
  {
    no: '', part_no: '', job_no: '', model: '', line: '', desc: '%',
    ...generatePercentFields([100, 80, 0, 0, 0, 0, 0, 0, '', '']),
    total_plan: '', total_actual: '', achievement: 17
  }
])
</script>

<style scoped>
.cell-span {
  background-color: #f5f5f5;
  vertical-align: middle;
}
</style>