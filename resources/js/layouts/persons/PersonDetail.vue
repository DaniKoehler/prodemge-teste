<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="mx-auto" max-width="650">
                    <v-card-title>
                        <h1>Detalhes da Pessoa</h1>
                    </v-card-title>
                    <v-card-text>
                        <div v-if="isFetching">
                            <v-progress-circular indeterminate color="primary"></v-progress-circular>
                        </div>
                        <div v-else>
                            <div v-if="person">
                                <v-list dense>
                                    <v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>Nome</v-list-item-title>
                                            <v-list-item-subtitle>{{ person.name }}</v-list-item-subtitle>
                                        </v-list-item>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>Nome Social</v-list-item-title>
                                            <v-list-item-subtitle>{{ person.social_name }}</v-list-item-subtitle>
                                        </v-list-item>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>CPF</v-list-item-title>
                                            <v-list-item-subtitle>{{ person.cpf }}</v-list-item-subtitle>
                                        </v-list-item>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>Nome do Pai</v-list-item-title>
                                            <v-list-item-subtitle>{{ person.father_name }}</v-list-item-subtitle>
                                        </v-list-item>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>Nome da Mãe</v-list-item-title>
                                            <v-list-item-subtitle>{{ person.mother_name }}</v-list-item-subtitle>
                                        </v-list-item>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>Telefone</v-list-item-title>
                                            <v-list-item-subtitle>{{ person.phone }}</v-list-item-subtitle>
                                        </v-list-item>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-list-item>
                                            <v-list-item-title>Email</v-list-item-title>
                                            <v-list-item-subtitle>{{ person.email }}</v-list-item-subtitle>
                                        </v-list-item>
                                    </v-list-item>
                                </v-list>
                                <v-divider class="my-4"></v-divider>
                                <h2>Endereços</h2>
                                <v-list dense>
                                    <v-list-item v-for="address in addresses" :key="address.id">
                                        <v-list-item>
                                            <v-list-item-title>Endereço {{ address.type }}</v-list-item-title>
                                            <v-list-item-subtitle>
                                                {{ address.cep }}, {{ address.street }}, {{ address.number }},
                                                {{ address.neighborhood }}, {{ address.city }} - {{ address.state }}
                                            </v-list-item-subtitle>
                                        </v-list-item>
                                        <v-list-item-action class="pa-3">
                                            <v-btn
                                                color="blue"
                                                @click="$router.push({ name: 'AddressEdit', params: { id: address.id } })"
                                            >
                                                Editar
                                            </v-btn>
                                        </v-list-item-action>
                                    </v-list-item>
                                </v-list>
                            </div>
                            <div v-else>
                                <p>Pessoa não encontrada.</p>
                            </div>
                        </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" @click="$router.push({ name: 'AddressCreate', params: { personId: person.id } })">
                            Criar Endereço
                        </v-btn>
                        <v-btn color="primary" @click="$router.push({ name: 'AddressHistory', params: { id: person.id } })">
                            Historico de Endereços
                        </v-btn>
                        <v-btn color="secondary" @click="$router.push({ name: 'PersonList' })">
                            Voltar
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
            person: null,
            addresses: [],
            isFetching: false
        };
    },
    mounted() {
        this.isFetching = true;
        const id = this.$route.params.id;
        axios.get(`/api/persons/${id}`)
            .then(response => {
                if (response.data) {
                    this.person = response.data;
                    // Após obter os detalhes da pessoa, busca os endereços
                    return axios.get(`/api/addresses?person_id=${this.person.id}`);
                } else {
                    console.error('Nenhum dado retornado para este ID:', id);
                }
            })
            .then(response => {
                if (response && response.data) {
                    this.addresses = response.data;
                }
            })
            .catch(error => {
                console.error('Erro ao buscar detalhes da pessoa ou endereços:', error);
            })
            .finally(() => {
                this.isFetching = false;
            });
    },
};
</script>
