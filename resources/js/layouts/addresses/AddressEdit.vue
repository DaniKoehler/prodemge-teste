<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="mx-auto" max-width="600">
                    <v-card-title>
                        <h1>Editar Endereço</h1>
                    </v-card-title>
                    <v-card-text>
                        <v-form @submit.prevent="updateAddress">
                            <v-select
                                v-model="address.type"
                                :items="['Residencial', 'Comercial']"
                                label="Tipo"
                                required
                            ></v-select>
                            <v-text-field
                                v-model="address.cep"
                                label="CEP"
                                @blur="fetchCep"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="address.street"
                                label="Rua"
                                :disabled="fieldsDisabled.street"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="address.number"
                                label="Número"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="address.complement"
                                label="Complemento"
                            ></v-text-field>
                            <v-text-field
                                v-model="address.neighborhood"
                                label="Bairro"
                                :disabled="fieldsDisabled.neighborhood"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="address.state"
                                label="Estado"
                                :disabled="fieldsDisabled.state"
                                required
                            ></v-text-field>
                            <v-text-field
                                v-model="address.city"
                                label="Cidade"
                                :disabled="fieldsDisabled.city"
                                required
                            ></v-text-field>
                            <v-card-actions>
                                <v-btn color="primary" type="submit">
                                    Atualizar Endereço
                                </v-btn>
                                <v-btn color="error" @click="deleteAddress">
                                    Deletar Endereço
                                </v-btn>
                                <v-btn color="secondary" @click="$router.push({ name: 'PersonDetail', params: { id: address.person_id } })">
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
            address: {
                type: '',
                cep: '',
                street: '',
                number: '',
                complement: '',
                neighborhood: '',
                state: '',
                city: '',
                person_id: null
            },
            fieldsDisabled: {
                street: false,
                neighborhood: false,
                state: false,
                city: false
            }
        };
    },
    mounted() {
        this.fetchAddress();
    },
    methods: {
        fetchAddress() {
            const id = this.$route.params.id;
            axios.get(`/api/addresses/${id}`)
                .then(response => {
                    this.address = response.data;
                })
                .catch(error => {
                    console.error('Erro ao buscar o endereço:', error);
                });
        },
        fetchCep() {
            if (this.address.cep.length === 8) {
                axios.get(`https://viacep.com.br/ws/${this.address.cep}/json/`)
                    .then(response => {
                        const { logradouro, bairro, uf, localidade } = response.data;
                        this.address.street = logradouro;
                        this.address.neighborhood = bairro;
                        this.address.state = uf;
                        this.address.city = localidade;

                        this.fieldsDisabled.street = !!logradouro;
                        this.fieldsDisabled.neighborhood = !!bairro;
                        this.fieldsDisabled.state = !!uf;
                        this.fieldsDisabled.city = !!localidade;
                    })
                    .catch(error => {
                        console.error('Erro ao buscar CEP:', error);
                    });
            }
        },
        updateAddress() {
            const id = this.$route.params.id;
            axios.put(`/api/addresses/${id}`, this.address)
                .then(() => {
                    alert('Endereço atualizado com sucesso!');
                    this.$router.push(`/persons/${this.address.person_id}`);
                })
                .catch(error => {
                    console.error('Erro ao atualizar o endereço:', error);
                });
        },
        deleteAddress() {
            const confirmDelete = confirm('Tem certeza que deseja deletar este endereço?');
            if (confirmDelete) {
                const id = this.$route.params.id;
                axios.delete(`/api/addresses/${id}`)
                    .then(() => {
                        alert('Endereço deletado com sucesso!');
                        this.$router.push(`/persons/${this.address.person_id}`);
                    })
                    .catch(error => {
                        console.error('Erro ao deletar o endereço:', error);
                    });
            }
        }
    }
};
</script>
