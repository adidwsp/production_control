<template>
  <v-card flat>
    <!-- Search Bar -->
    <v-card-title>Monitoring Production</v-card-title>
    <v-text-field
      v-model="search"
      label="Search Part No"
      append-icon="$magnify"
      clearable
      @click:clear="clearFilter"
      class="mb-4"
      variant="outlined"
      hide-details
      style="max-width: 300px;"
      placeholder="Enter part number to search"
    />

    <!-- Table Container with scroll -->
    <div class="table-container">
    <table class="my-table">
      <thead>
        <tr>
          <th class="sticky-col1" rowspan="3">No</th>
          <th class="sticky-col2" rowspan="3">Part No</th>
          <th class="sticky-col3" rowspan="3">Job No</th>
          <th class="sticky-col4" rowspan="3">Model</th>
          <th class="sticky-col5" rowspan="3">Line</th>
          <th class="sticky-col6" rowspan="3">Desc.</th>
          <th :colspan="dates.length * 2">Schedule</th>
          <th rowspan="3">Total</th>
        </tr>
        <tr>
          <th v-for="date in dates" :key="date" colspan="2">
            {{ date }}
          </th>
        </tr>
        <tr>
          <template v-for="date in dates" :key="date">
            <th>D</th><th>N</th>
          </template>
        </tr>
      </thead>
      <tbody>
        <template v-for="(row, idx) in filteredRows" :key="row.partNo">
          <!-- DELIVERY -->
          <tr>
            <td class="sticky-col1" :rowspan="4">{{ idx+1 }}</td>
            <td class="sticky-col2" :rowspan="4">{{ row.partNo }}</td>
            <td class="sticky-col3" :rowspan="4">{{ row.jobNo }}</td>
            <td class="sticky-col4" :rowspan="4">{{ row.model }}</td>
            <td class="sticky-col5" :rowspan="4">{{ row.line }}</td>
            <td class="sticky-col6">DLV.</td>
            <template v-for="date in dates" :key="date+'dlv'">
              <td>{{ row.data[date]?.D.dlv||'-' }}</td>
              <td>{{ row.data[date]?.N.dlv||'-' }}</td>
            </template>
            <td>{{ totalDlv(row) }}</td>
          </tr>
          <!-- PLAN -->
          <tr>
            <td class="sticky-col6">PLAN</td>
            <template v-for="date in dates" :key="row.partNo + date + '-plan'">
              <td>{{ row.data[date]?.D.plan ?? '-' }}</td>
              <td>{{ row.data[date]?.N.plan ?? '-' }}</td>
            </template>
            <td>{{ totalPlan(row) }}</td>
          </tr>
          <!-- ACTUAL -->
          <tr>
            <td class="sticky-col6">ACT.</td>
            <template v-for="date in dates" :key="row.partNo + date + '-act'">
              <td>{{ row.data[date]?.D.act ?? '-' }}</td>
              <td>{{ row.data[date]?.N.act ?? '-' }}</td>
            </template>
            <td>{{ totalAct(row) }}</td>
          </tr>
          <!-- PERCENTAGE -->
          <tr>
            <td class="sticky-col6">%</td>
            <template v-for="date in dates" :key="row.partNo + date + '-pct'">
              <td>{{ pct(row.data[date]?.D) }}</td>
              <td>{{ pct(row.data[date]?.N) }}</td>
            </template>
            <td>{{ totalPct(row) }}</td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
  </v-card>
</template>


<script setup>
import { ref, computed } from 'vue'
import { useDataStore } from '@/stores/dataStore'
import { storeToRefs } from 'pinia'





// Search
const search = ref('')
const normalize = str =>
  str
    ? str.replace(/[‐-―−]/g, '-')
         .toLowerCase()
    : ''

// Generate dates from 1 to last day of current month
const today = new Date()
const year = today.getFullYear()
const month = today.getMonth() + 1 // 1-based
const daysInMonth = new Date(year, month, 0).getDate()
const dates = ref(
  Array.from({ length: daysInMonth }, (_, i) =>
    String(i + 1).padStart(2, '0') + '/' + String(month).padStart(2, '0') + '/' + String(year).slice(-2)
  )
)
// Sample rows data (replace with API)
const rows = ref([
  {
    partNo: '65111‑I7000',
    jobNo:  '65111‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 100, act: 100 }, N: { dlv: 100, plan: 100, act: 80  }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act:   0 }, N: { dlv: 100, plan: 120, act:   0 }},
      // … dst
    },
    totalPlan:   1080,
    totalActual: 180,
  },
  {
    partNo: '65111‑I7900',
    jobNo:  '65111‑I7900',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan:   100, act:   100 }, N: { dlv: 100, plan:   100, act: 20  }},
      '02/08/25':  { D: { dlv: 100, plan:   100, act:   100 }, N: { dlv: 100, plan:   100, act:   100 }},
      // … dst
    },
    totalPlan:   60,
    totalActual: 20,
  },
  {
    partNo: '65131‑I7000',
    jobNo:  '65131‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
  {
    partNo: '65197‑I7000',
    jobNo:  '65197‑I7000',
    model:  'SU2ID',
    line:   'SA HMMI',
    data: {
      '01/08/25': { D: { dlv: 100, plan: 140, act: 140 }, N: { dlv: 100, plan: 140, act: 120 }},
      '02/08/25':  { D: { dlv: 100, plan: 120, act: 120 }, N: { dlv: 100, plan: 120, act:  0 }},
      // … dst
    },
    totalPlan:   1260,
    totalActual: 260,
  },
])

// Filter rows by partNo
const filteredRows = computed(() => {
  const q = normalize(search.value)
  return q
    ? rows.value.filter(r => normalize(r.partNo).includes(q))
    : rows.value
})

// Percentage
function pct(cell) {
  if (!cell) return '-'
  if (cell.plan === 0) return cell.act > 0 ? '100%' : '0%'
  return Math.round((cell.act / cell.plan) * 100) + '%'
}

// Total calculations
function totalDlv(row) {
  return dates.value.reduce(
    (sum, d) => sum + (row.data[d]?.D.dlv || 0) + (row.data[d]?.N.dlv || 0),
    0
  )
}
function totalPlan(row) {
  return dates.value.reduce(
    (sum, d) => sum + (row.data[d]?.D.plan || 0) + (row.data[d]?.N.plan || 0),
    0
  )
}
function totalAct(row) {
  return dates.value.reduce(
    (sum, d) => sum + (row.data[d]?.D.act || 0) + (row.data[d]?.N.act || 0),
    0
  )
}
function totalPct(row) {
  const p = totalPlan(row)
  const a = totalAct(row)
  return p ? Math.round((a / p) * 100) + '%' : '-'
}

function clearFilter() {
  search.value = ''
}
</script>

<style scoped>
.v-card {
  padding: 16px;
  overflow: scroll;
}

.table-container {
  /* definisikan variable dalam container yang di-scope */
  --w1:  38.5px;
  --w2: 108.5px;
  --w3: 108.5px;
  --w4: 108.5px;
  --w5:  63px;
  --w6:  120px;

  width: calc(100vw - 50px);
  height: calc(100vh - 50px);
  overflow: auto;
  border: 1px solid #ddd;
}

.my-table {
  border-spacing: 0;
  width: max-content;
}

.my-table th,
.my-table td {
  border: 1px solid #ddd;
  padding: 4px 8px;
  text-align: center;
  white-space: nowrap;
  background: #fff;
}

/* header sticky */
.my-table thead tr:nth-child(1) th {
  position: sticky; top: 0; z-index: 10; background: #f5f5f5;
}
.my-table thead tr:nth-child(2) th {
  position: sticky; top: 34px; z-index: 9; background: #f5f5f5;
}
.my-table thead tr:nth-child(3) th {
  position: sticky; top: 68px; z-index: 9; background: #f5f5f5;
}

/* kolom 1–6 sticky via class */
.sticky-col1 {
  position: sticky; left: 0;
  width: var(--w1);  z-index: 7; background: #f5f5f5;
}
.sticky-col2 {
  position: sticky; left: var(--w1);
  width: var(--w2);  z-index: 6; background: #f5f5f5;
}
.sticky-col3 {
  position: sticky;
  left: calc(var(--w1) + var(--w2));
  width: var(--w3);  z-index: 5; background: #f5f5f5;
}
.sticky-col4 {
  position: sticky;
  left: calc(var(--w1) + var(--w2) + var(--w3));
  width: var(--w4);  z-index: 4; background: #f5f5f5;
}
.sticky-col5 {
  position: sticky;
  left: calc(var(--w1) + var(--w2) + var(--w3) + var(--w4));
  width: var(--w5);  z-index: 3; background: #f5f5f5;
}
.sticky-col6 {
  position: sticky;
  left: calc(var(--w1) + var(--w2) + var(--w3) + var(--w4) + var(--w5) + 22.3px);
  width: var(--w6);  z-index: 2; background: #f5f5f5;
}
</style>