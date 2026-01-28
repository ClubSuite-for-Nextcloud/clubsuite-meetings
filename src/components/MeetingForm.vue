<template>
    <div class="modal-overlay">
        <div class="modal">
            <h3>{{ meeting ? 'Sitzung bearbeiten' : 'Neue Sitzung' }}</h3>
            <form @submit.prevent="save">
                <div class="form-group">
                    <label>Titel</label>
                    <input type="text" v-model="form.title" required />
                </div>
                <div class="form-group">
                    <label>Datum</label>
                    <input type="date" v-model="form.date" required />
                </div>
                <div class="form-group">
                    <label>Typ</label>
                    <select v-model="form.type">
                        <option value="general">Mitgliederversammlung</option>
                        <option value="board">Vorstandssitzung</option>
                        <option value="committee">Ausschuss</option>
                    </select>
                </div>
                <div class="actions">
                    <button type="button" @click="$emit('close')">Abbrechen</button>
                    <button type="submit" class="primary">Speichern</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'

export default {
    name: 'MeetingForm',
    props: ['meeting'],
    data() {
        return {
            form: {
                title: '',
                date: new Date().toISOString().slice(0, 10),
                type: 'general'
            }
        }
    },
    mounted() {
        if (this.meeting) {
            this.form = { ...this.meeting }
        }
    },
    methods: {
        async save() {
            try {
                if (this.meeting) {
                    await axios.put(generateUrl(`/apps/clubsuite-meetings/meetings/${this.meeting.id}`), this.form)
                } else {
                    await axios.post(generateUrl('/apps/clubsuite-meetings/meetings'), this.form)
                }
                this.$emit('saved')
                this.$emit('close')
            } catch (e) {
                console.error(e)
                alert('Fehler beim Speichern (Rechte?)')
            }
        }
    }
}
</script>

<style scoped>
.modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center; z-index: 1001; }
.modal { background: white; padding: 20px; border-radius: 5px; min-width: 400px; }
.form-group { margin-bottom: 10px; display: flex; flex-direction: column; }
.actions { margin-top: 15px; display: flex; justify-content: flex-end; gap: 10px; }
</style>
