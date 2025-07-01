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
            <th rowspan="3" >No</th>
            <th rowspan="3" >Part No</th>
            <th rowspan="3" >Job No</th>
            <th rowspan="3" >Model</th>
            <th rowspan="3" >Line</th>
            <th rowspan="3" >Desc.</th>
            <th :colspan="dates.length * 2">Schedule</th>
            <th rowspan="3">Total</th>
          </tr>
          <tr>
            <th
              v-for="date in dates"
              :key="date + '-header-date'"
              colspan="2"
            >
              {{ date }}
            </th>
          </tr>
          <tr>
            <template v-for="date in dates" :key="date">
              <th>D</th>
              <th>N</th>
            </template>
          </tr>
        </thead>
        <tbody>
          <template v-for="(row, idx) in filteredRows" :key="row.partNo">
            <!-- PLAN -->
            <tr>
              <td :rowspan="3" >{{ idx + 1 }}</td>
              <td :rowspan="3" >{{ row.partNo }}</td>
              <td :rowspan="3" >{{ row.jobNo }}</td>
              <td :rowspan="3" >{{ row.model }}</td>
              <td :rowspan="3" >{{ row.line }}</td>
              <td >PLAN</td>
              <template v-for="date in dates" :key="row.partNo + date + '-plan'">
                <td>{{ row.data[date]?.D.plan ?? '-' }}</td>
                <td>{{ row.data[date]?.N.plan ?? '-' }}</td>
              </template>
              <td>{{ totalPlan(row) }}</td>
              <!-- <td :rowspan="3">
                <div>
                  PL: {{ totalPlan(row) }}<br />
                  AC: {{ totalAct(row) }}<br />
                  {{ totalPct(row) }}
                </div>
              </td> -->
            </tr>
            <!-- ACTUAL -->
            <tr>
              <td>ACT.</td>
              <template v-for="date in dates" :key="row.partNo + date + '-act'">
                <td>{{ row.data[date]?.D.act ?? '-' }}</td>
                <td>{{ row.data[date]?.N.act ?? '-' }}</td>
              </template>
              <td>{{ totalAct(row) }}</td>
            </tr>
            <!-- PERCENTAGE -->
            <tr>
              <td>%</td>
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
      '01/07/25': { D: { plan: 100, act: 100 }, N: { plan: 100, act: 80  }},
      '02/07/25':  { D: { plan: 120, act:   0 }, N: { plan: 120, act:   0 }},
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
      '01/07/25': { D: { plan:   100, act:   100 }, N: { plan:   100, act: 20  }},
      '02/07/25':  { D: { plan:   100, act:   100 }, N: { plan:   100, act:   100 }},
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
      '01/07/25': { D: { plan: 140, act: 140 }, N: { plan: 140, act: 120 }},
      '02/07/25':  { D: { plan: 120, act: 120 }, N: { plan: 120, act:  0 }},
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
      '01/07/25': { D: { plan: 140, act: 140 }, N: { plan: 140, act: 120 }},
      '02/07/25':  { D: { plan: 120, act: 120 }, N: { plan: 120, act:  0 }},
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
.v-card { padding: 16px; }
.table-container {
  overflow: auto;
  max-height: 600px;
}
.my-table {
  width: 100%;
  border-collapse: collapse;
}
.my-table th,
.my-table td {
  border: 1px solid #ddd;
  padding: 4px 8px;
  text-align: center;
  background: #fff;
}
/* Sticky header rows */
.my-table th {
  position: sticky;
  top: 0;
  background: #f9f9f9;
  z-index: 2;
}
/* Freeze static columns */
.sticky-col {
  position: sticky;
  left: 0;
  z-index: 3;
  background: #fff;
}
/* Adjust left offsets for each static column */
.col-no { left: 0; }
.col-part { left: 40px; }
.col-job { left: 140px; }
.col-model { left: 260px; }
.col-line { left: 340px; }
.col-desc { left: 420px; }
</style>
