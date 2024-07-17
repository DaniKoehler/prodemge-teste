<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="mx-auto" max-width="600">
                    <v-card-title>
                        <h1>Lista de Pessoas</h1>
                    </v-card-title>
                    <v-card-text>
                        <v-list>
                            <v-list-item v-for="person in persons" :key="person.id" class="pa-5">
                                <v-list-item>
                                    <v-list-item-title>{{ person.name }}</v-list-item-title>
                                    <v-list-item-subtitle>{{ person.cpf }} - {{ person.email }}</v-list-item-subtitle>
                                </v-list-item>
                                <v-list-item-action class="pa-3 justify-space-between">
                                    <v-btn
                                        @click="$router.push({ name: 'PersonDetail', params: { id: person.id } })"
                                    >
                                        Detalhes
                                    </v-btn>
                                    <v-btn
                                        @click="$router.push({ name: 'PersonEdit', params: { id: person.id } })"
                                    >
                                        Editar
                                    </v-btn>
                                    <v-btn
                                        color="red"
                                        @click="deletePerson(person.id)"
                                    >
                                        Excluir
                                    </v-btn>
                                </v-list-item-action>
                            </v-list-item>
                        </v-list>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" @click="$router.push({ name: 'PersonCreate' })">
                            Cadastrar Pessoa
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            persons: [],
            isFetching: false,
        };
    },
    mounted() {
        this.fetchPersons();
    },
    methods: {
        fetchPersons() {
            if (!this.isFetching) {
                this.isFetching = true;
                axios.get('/api/persons')
                    .then(response => {
                        this.persons = response.data;
                    })
                    .catch(error => {
                        console.error("There was an error fetching the persons:", error);
                    })
                    .finally(() => {
                        this.isFetching = false;
                    });
            }
        },
        deletePerson(id) {
            if (confirm('Tem certeza que deseja excluir esta pessoa?')) {
                axios.delete(`/api/persons/${id}`)
                    .then(() => {
                        alert('Pessoa excluída com sucesso.');
                        this.fetchPersons();
                    })
                    .catch(error => {
                        console.error('Erro ao excluir pessoa:', error);
                        alert('Erro ao excluir pessoa.');
                    });
            }
        }
    },
};
</script>
