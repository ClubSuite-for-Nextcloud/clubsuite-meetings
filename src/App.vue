<template>
    <div id="app">
        <ul class="tab-headers">
            <li :class="{ active: currentView === 'meetings' }" @click="currentView = 'meetings'">Sitzungen</li>
        </ul>

        <div class="tab-content">
            <Meetings v-if="currentView === 'meetings'" />
        </div>
    </div>
</template>

<script>
import Meetings from './views/Meetings.vue'

export default {
    name: 'App',
    components: {
        Meetings
    },
    data() {
        return {
            currentView: 'meetings'
        }
    }
}
</script>

<style scoped>
.tab-headers { display: flex; list-style: none; padding: 0; border-bottom: 2px solid #ddd; margin-bottom: 20px; }
.tab-headers li { padding: 10px 20px; cursor: pointer; border: 1px solid transparent; border-bottom: none; }
.tab-headers li.active { background-color: #f7f7f7; border-color: #ddd; font-weight: bold; }
</style>
