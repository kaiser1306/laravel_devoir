<template>
  <div class="stats-widget">
    <div class="stats-header">
      <h3>{{ title }}</h3>
      <div class="stats-value">
        <span class="number">{{ value }}</span>
        <span class="label">{{ label }}</span>
      </div>
    </div>
    <div class="stats-details" v-if="details">
      <div v-for="(detail, index) in details" :key="index" class="stat-detail">
        <span class="detail-label">{{ detail.label }}</span>
        <span class="detail-value">{{ detail.value }}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    value: {
      type: Number,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    details: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style scoped>
.stats-widget {
  background: white;
  border-radius: 8px;
  padding: 1.5rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  margin-bottom: 1rem;
}

.stats-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.stats-value {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.number {
  font-size: 2rem;
  font-weight: bold;
  color: #003366;
}

.label {
  font-size: 0.8rem;
  color: #666;
}

.stats-details {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 1rem;
}

.stat-detail {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem;
  background: #f8f9fa;
  border-radius: 4px;
}

.detail-label {
  color: #666;
}

.detail-value {
  font-weight: bold;
  color: #003366;
}
</style>
