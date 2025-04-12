<script setup lang="ts">
import { ref, shallowRef } from 'vue';

import BaseBreadcrumb from '@/components/shared/BaseBreadcrumb.vue';
import UiParentCard from '@/components/shared/UiParentCard.vue';
import ProductionSheet from '@/views/forms/ProductionSheet.vue';
import ProductionSheetAgGrid from '@/views/forms/ProductionSheetAgGrid.vue';


const dialog = ref(false);
const dialogag = ref(false);
const mode = ref<'edit' | 'view'>('view'); // Bisa diisi 'edit' atau 'view'

const page = ref({ title: 'Production Welding' });
const breadcrumbs = shallowRef([
  {
    title: 'Production',
    disabled: false,
    href: '#'
  },
  {
    title: 'Production Welding',
    disabled: true,
    href: '#'
  }
]);

const edit = () => {
  mode.value = 'edit';
  dialog.value = true;
};

const view = () => {
  mode.value = 'view';
  dialog.value = true;
};

const editag = () => {
  mode.value = 'edit';
  dialogag.value = true;
};

const viewag = () => {
  mode.value = 'view';
  dialogag.value = true;
};

</script>

<template>
  <BaseBreadcrumb :title="page.title" :breadcrumbs="breadcrumbs"></BaseBreadcrumb>
  <v-row>
    <v-col cols="12" md="12">
      <UiParentCard title="Welding Line Sub Assy ADM">

        <v-row class="d-flex justify-space-between ga-4"
        >
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">SUB ASSY ROBOT</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>
            
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">SUB ASSY MANUAL</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">S/A CO ROBOT</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

        </v-row>
        
      </UiParentCard>
    </v-col>
  </v-row>
  <v-row>
    <v-col cols="12" md="12">
      <UiParentCard title="Welding Line WSS ADM">

        <v-row class="d-flex justify-space-between ga-4"
        >
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE A</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>
            
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE B</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">SWSS LINE C</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

        </v-row>
        <br>
        <br>

        <v-row class="d-flex justify-space-between ga-4"
        >
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE D</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>
            
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE E</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE F</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

        </v-row>
        
      </UiParentCard>
      <UiParentCard title="Welding Line AG-GRID">

<v-row class="d-flex justify-space-between ga-4"
>
    <v-card
        max-width="350"
        color="darkprimary"
    >
    <v-card-text class="d-flex justify-space-between align-center">
        <h4 class="me-3">SUB ASSY ROBOT</h4>
        <v-chip
            prepend-icon="$eye"
            @click="viewag"
        >VIEW
        </v-chip>
        <v-chip
            prepend-icon="$edit"
            @click="editag"
            color="darksuccess"
            variant="flat"
        >EDIT
        </v-chip>
    </v-card-text>
    </v-card>

</v-row>

</UiParentCard>
    </v-col>
  </v-row>




<!-- Dialog untuk menampilkan ProductionSheet.vue -->
<v-dialog v-model="dialog" max-width="1200">
    <v-card>
      <v-card-text>
        <!-- Masukkan komponen ProductionSheet dengan prop mode -->
        <ProductionSheet :mode="mode" />
      </v-card-text>
      <v-card-actions>
        <v-btn color="darkGray" variant="flat" @click="dialog = false">Close</v-btn>
      </v-card-actions>
    </v-card>
</v-dialog>
<v-dialog v-model="dialogag" max-width="1200">
    <v-card>
      <v-card-text>
        <!-- Masukkan komponen ProductionSheet dengan prop mode -->
        <ProductionSheetAgGrid :mode="mode" />
      </v-card-text>
      <v-card-actions>
        <v-btn color="darkGray" variant="flat" @click="dialogag = false">Close</v-btn>
      </v-card-actions>
    </v-card>
</v-dialog>


</template>

<style scoped>

</style>
