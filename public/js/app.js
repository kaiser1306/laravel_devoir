import { createApp } from 'vue';
import StatsWidget from './components/StatsWidget.vue';
import StudentList from './components/StudentList.vue';
import EvaluationList from './components/EvaluationList.vue';

const app = createApp({
    components: {
        StatsWidget,
        StudentList,
        EvaluationList
    }
});

app.mount('#app');
