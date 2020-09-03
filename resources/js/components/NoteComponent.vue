<template>
    <div>
        <h3>Add Note: </h3>
        <form @submit.prevent="add">
            <input v-model="note.name" type="text" placeholder="Name" class="form-control mb-2"> 
            <input v-model="note.description" type="text" placeholder="Description" class="form-control mb-2"> 
            <button class="btn btn-primary">Add</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            notes: [],
            note: {
                name: '',
                description: ''
            }
        }
    },
    methods: {
        add() {
            if(this.note.name.trim() === '' || this.note.description.trim() == '') {
                alert('You must fill all the fields before saving !');
                return;
            }

            console.log(this.note.name, this.note.description);

            const params = {
                name: this.note.name,
                description: this.note.description
            };

            this.note.name = '';
            this.note.description = '';

            axios.post('/notes', params)
                .then(note => {
                    this.notes.push(note);
                });
        }
    }
}
</script>