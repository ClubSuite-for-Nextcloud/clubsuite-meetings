<template>
    <div class="meetings-view">
        <div class="actions">
            <button class="primary" @click="showForm = true">Neue Sitzung</button>
        </div>

        <table class="list-table">
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Titel</th>
                    <th>Typ</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="meeting in meetings" :key="meeting.id">
                    <td>{{ meeting.date }}</td>
                    <td>{{ meeting.title }}</td>
                    <td>{{ meeting.type }}</td>
                    <td>
                        <button @click="openDetails(meeting)">Details / Agenda</button>
                        <button @click="edit(meeting)">Bearbeiten</button>
                        <button class="error" @click="remove(meeting.id)">Löschen</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <MeetingForm 
            v-if="showForm" 
            :meeting="selectedMeeting" 
            @close="closeForm" 
            @saved="fetchData" 
        />

        <div v-if="detailMeeting" class="modal-overlay">
            <div class="modal large-modal">
                <div class="modal-header">
                    <h3>Agenda für: {{ detailMeeting.title }}</h3>
                    <button @click="detailMeeting = null">Schließen</button>
                </div>
                <AgendaList :meetingId="detailMeeting.id" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'
import MeetingForm from '../components/MeetingForm.vue'
import AgendaList from '../components/AgendaList.vue'

export default {
    name: 'Meetings',
    components: { MeetingForm, AgendaList },
    data() {
        return {
            meetings: [],
            showForm: false,
            selectedMeeting: null,
            detailMeeting: null
        }
    },
    mounted() {
        this.fetchData()
    },
    methods: {
        async fetchData() {
            try {
                const response = await axios.get(generateUrl('/apps/clubsuite-meetings/meetings'))
                this.meetings = response.data
            } catch (e) {
                console.error(e)
            }
        },
        edit(meeting) {
            this.selectedMeeting = meeting
            this.showForm = true
        },
        async remove(id) {
            if (!confirm('Wirklich löschen?')) return;
            try {
                await axios.delete(generateUrl(`/apps/clubsuite-meetings/meetings/${id}`))
                this.fetchData()
            } catch (e) {
                console.error(e)
                alert('Fehler beim Löschen')
            }
        },
        closeForm() {
            this.showForm = false
            this.selectedMeeting = null
        },
        openDetails(meeting) {
            this.detailMeeting = meeting
        }
    }
}
</script>

<style scoped>
.list-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
.list-table th, .list-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
.actions { margin-bottom: 15px; }
.modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center; z-index: 1000; }
.modal { background: white; padding: 20px; border-radius: 5px; min-width: 400px; max-height: 90vh; overflow-y: auto; }
.large-modal { width: 800px; }
.modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
</style>
