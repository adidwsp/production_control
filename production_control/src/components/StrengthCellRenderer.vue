<template>
  <span :class="cssClass">{{ formattedValue }}</span>
</template>

<script>
export default {
  name: 'StrengthCellRenderer',
  props: ['params'],
  computed: {
    formattedValue() {
      // ensure numeric formatting with one decimal
      const val = parseFloat(this.params.value);
      return isNaN(val) ? this.params.value : val.toFixed(1);
    },
    cssClass() {
      const val = parseFloat(this.params.value);
      if (isNaN(val)) return '';
      if (val >= 1) return 'strength-good';
      if (val >= 0.5) return 'strength-warning';
      return 'strength-bad';
    }
  }
};
</script>

<style scoped>
.strength-good {
  display: block;
  width: 100%;
  height: 100%;
  background-color: #c8e6c9;
  text-align: center;
}
.strength-warning {
  display: block;
  width: 100%;
  height: 100%;
  background-color: #fff9c4;
  text-align: center;
}
.strength-bad {
  display: block;
  width: 100%;
  height: 100%;
  background-color: #ffcdd2;
  text-align: center;
}
</style>
