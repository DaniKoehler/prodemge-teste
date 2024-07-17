<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="mx-auto" max-width="600">
                    <v-card-title>
                        <h1>Cadastrar Pessoa</h1>
                    </v-card-title>
                    <v-card-text>
                        <v-form @submit.prevent="submitForm">
                            <v-text-field
                                v-model="person.name"
                                label="Nome"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="person.social_name"
                                label="Nome Social"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="person.cpf"
                                label="CPF"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="person.father_name"
                                label="Nome do Pai"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="person.mother_name"
                                label="Nome da Mãe"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="person.phone"
                                label="Telefone"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="person.email"
                                label="Email"
                                type="email"
                                required
                            ></v-text-field>
                            <v-card-actions>
                                <v-btn color="primary" type="submit">
                                    Cadastrar
                                </v-btn>
                                <v-btn color="secondary" @click="$router.push({ name: 'PersonList' })">
                                    Voltar
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card-text>
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
            person: {
                name: '',
                social_name: '',
                cpf: '',
                father_name: '',
                mother_name: '',
                phone: '',
                email: ''
            }
        };
    },
    methods: {
        submitForm() {
            axios.post('/api/persons/create', this.person)
                .then(response => {
                    alert('Pessoa cadastrada com sucesso!');
                    this.person = { name: '', social_name: '', cpf: '', father_name: '', mother_name: '', phone: '', email: '' };
                })
                .catch(error => {
                    console.error('Erro ao cadastrar pessoa:', error);
                    alert('Erro ao cadastrar pessoa.');
                });
        }
    }
};
</script>
