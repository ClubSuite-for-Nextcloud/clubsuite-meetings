<template>
    <div class="agenda-list">
        <div class="actions">
            <button class="primary" @click="showForm = true; selectedItem = null">Neuer Punkt</button>
        </div>

        <table class="list-table">
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Beschluss / Notiz</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.id">
                    <td>{{ item.title }}</td>
                    <td>{{ item.decision }}</td>
                    <td>
                        <button @click="edit(item)">Bearbeiten</button>
                        <button class="error" @click="remove(item.id)">Löschen</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <AgendaItemForm 
            v-if="showForm" 
            :meetingId="meetingId" 
            :item="selectedItem" 
            @close="showForm = false" 
            @saved="fetchData" 
        />
    </div>
</template>

<script>
import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'
import AgendaItemForm from './AgendaItemForm.vue'

export default {
    name: 'AgendaList',
    components: { AgendaItemForm },
    props: ['meetingId'],
    data() {
        return {
            items: [],
            showForm: false,
            selectedItem: null
        }
    },
    watch: {
        meetingId: {
            immediate: true,
            handler() {
                this.fetchData()
            }
        }
    },
    methods: {
        async fetchData() {
            if (!this.meetingId) return;
            try {
                const response = await axios.get(generateUrl(`/apps/clubsuite-meetings/meetings/${this.meetingId}/agenda`))
                this.items = response.data
            } catch (e) {
                console.error(e)
            }
        },
        edit(item) {
            this.selectedItem = item
            this.showForm = true
        },
        async remove(id) {
            if (!confirm('Wirklich löschen?')) return;
            try {
                await axios.delete(generateUrl(`/apps/clubsuite-meetings/agenda/${id}`))
                this.fetchData()
            } catch (e) {
                console.error(e)
            }
        }
    }
}
</script>

<style scoped>
.list-table { width: 100%; border-collapse: collapse; }
.list-table th, .list-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
</style>
