<template>
    <div>
        <form @submit.prevent="editNote(note)" v-if="editing">
            <h3>Edit Note: </h3>
            <input v-model="note.name" type="text" placeholder="Name" class="form-control mb-2"> 
            <input v-model="note.description" type="text" placeholder="Description" class="form-control mb-2"> 
            <button class="btn btn-warning">Update</button>
            <button class="btn btn-danger" @click="cancelEditing">Cancel</button>
        </form>

        <form @submit.prevent="add" v-else>
            <h3>Add Note: </h3>
            <input v-model="note.name" type="text" placeholder="Name" class="form-control mb-2"> 
            <input v-model="note.description" type="text" placeholder="Description" class="form-control mb-2"> 
            <button class="btn btn-primary">Add</button>
        </form>
        
        <hr class="mt-3">
        <h3>Note list:</h3>
        <ul class="list-group my-2">
            <li class="list-group-item" 
                v-for="(item, index) in notes" :key="index">
                <span class="badge badge-primary float-right">
                    {{ item.updated_at}}
                </span>
                <p>{{ item.name }}</p>
                <p>{{ item.description }}</p>
                <button class="btn btn-danger btn-sm"
                        @click="deleteNote(item, index)">Delete</button>
                <button class="btn btn-warning btn-sm"
                        @click="editForm(item)">Edit</button>
            </li>
        </ul>
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
            },
            editing: false
        }
    },
    created() {
        axios.get('/notes')
            .then( res => {
                this.notes =  res.data;
            });
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
                    this.notes.push(note.data);
                });
        },
        deleteNote(item, index) {
            axios.delete(`/notes/${item.id}`)
                .then(() => {
                    this.notes.splice(index, 1);
                }); 
        },
        editForm(item) {
            this.editing = true;
            this.note.name = item.name;
            this.note.description = item.description;
            this.note.id = item.id;
        },
        editNote(item) {
            const params = {
                name: item.name,
                description: item.description,
            };
            axios.put(`/notes/${item.id}`, params)
                .then((res) => {
                    const index = this.notes.findIndex(search => {
                        return search.id == res.data.id;
                    });
                    this.notes[index].name = res.data.name;
                    this.notes[index].description = res.data.description;
                    this.cancelEditing();
                });
        },
        cancelEditing() {
            this.editing = false;
            this.note.name = '';
            this.note.description = '';
        }
    }
}
</script>