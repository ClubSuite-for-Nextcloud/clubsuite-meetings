<template>
    <div class="modal-overlay">
        <div class="modal">
            <h3>{{ item ? 'Punkt bearbeiten' : 'Neuer Agenda-Punkt' }}</h3>
            <form @submit.prevent="save">
                <div class="form-group">
                    <label>Titel</label>
                    <input type="text" v-model="form.title" required />
                </div>
                <div class="form-group">
                    <label>Beschluss / Notiz</label>
                    <textarea v-model="form.decision" rows="5"></textarea>
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
    name: 'AgendaItemForm',
    props: ['meetingId', 'item'],
    data() {
        return {
            form: {
                title: '',
                decision: ''
            }
        }
    },
    mounted() {
        if (this.item) {
            this.form = { ...this.item }
        }
    },
    methods: {
        async save() {
            try {
                if (this.item) {
                    await axios.put(generateUrl(`/apps/clubsuite-meetings/agenda/${this.item.id}`), this.form)
                } else {
                    await axios.post(generateUrl(`/apps/clubsuite-meetings/meetings/${this.meetingId}/agenda`), this.form)
                }
                this.$emit('saved')
                this.$emit('close')
            } catch (e) {
                console.error(e)
                alert('Fehler beim Speichern')
            }
        }
    }
}
</script>

<style scoped>
.modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center; z-index: 1002; }
.modal { background: white; padding: 20px; border-radius: 5px; min-width: 400px; }
.form-group { margin-bottom: 10px; display: flex; flex-direction: column; }
.actions { margin-top: 15px; display: flex; justify-content: flex-end; gap: 10px; }
</style>
