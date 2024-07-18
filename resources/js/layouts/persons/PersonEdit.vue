<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="mx-auto" max-width="600">
                    <v-card-title>
                        <h1>Editar Pessoa</h1>
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
                            ></v-text-field>
                            <v-text-field
                                v-model="person.cpf"
                                v-mask="'###.###.###-##'"
                                label="CPF"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="person.father_name"
                                label="Nome do Pai"
                            ></v-text-field>
                            <v-text-field
                                v-model="person.mother_name"
                                label="Nome da Mãe"
                            ></v-text-field>
                            <v-text-field
                                v-model="person.phone"
                                v-mask="'(##) #####-####'"
                                label="Telefone"
                            ></v-text-field>
                            <v-text-field
                                v-model="person.email"
                                label="Email"
                                type="email"
                                required
                            ></v-text-field>
                            <v-card-actions>
                                <v-btn color="primary" type="submit">
                                    Salvar Alterações
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
import { mask } from 'vue-the-mask';

export default {
    directives: { mask },
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
    mounted() {
        const id = this.$route.params.id;
        axios.get(`/api/persons/${id}`)
            .then(response => {
                this.person = response.data;
            })
            .catch(error => {
                console.error('Erro ao buscar dados da pessoa:', error);
            });
    },
    methods: {
        submitForm() {
            const id = this.$route.params.id;
            axios.put(`/api/persons/${id}`, this.person)
                .then(() => {
                    alert('Pessoa atualizada com sucesso!');
                    this.$router.push('/persons');
                })
                .catch(error => {
                    console.error('Erro ao atualizar pessoa:', error);
                    alert('Erro ao atualizar pessoa.');
                });
        }
    }
};
</script>
