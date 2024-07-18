<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="mx-auto" max-width="600">
                    <v-card-title>
                        <h1>Criar Endereço</h1>
                    </v-card-title>
                    <v-card-text>
                        <v-form @submit.prevent="saveAddress">
                            <v-select
                                v-model="address.type"
                                :items="['Residencial', 'Comercial']"
                                label="Tipo"
                                :disabled="fieldsDisabled.type"
                                required
                            ></v-select>
                            <v-text-field
                                v-model="address.cep"
                                v-mask="'#####-###'"
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
                                    Salvar Endereço
                                </v-btn>
                                <v-btn color="secondary" @click="$router.push({ name: 'PersonDetail', params: { id: personId } })">
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
import { mask } from 'vue-the-mask'

export default {
    directives: { mask },
    props: ['personId'],
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
                person_id: this.personId || null
            },
            fieldsDisabled: {
                type: false,
                street: false,
                neighborhood: false,
                state: false,
                city: false
            }
        };
    },
    methods: {
        fetchCep() {
            if (this.address.cep.length === 8) {
                axios.get(`https://viacep.com.br/ws/${this.address.cep}/json/`)
                    .then(response => {
                        const { logradouro, bairro, uf, localidade } = response.data;
                        this.address.street = logradouro;
                        this.address.neighborhood = bairro;
                        this.address.state = uf;
                        this.address.city = localidade;

                        // Bloquear campos preenchidos automaticamente
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
        saveAddress() {
            axios.post('/api/addresses/create', this.address)
                .then(response => {
                    alert('Endereço salvo com sucesso!');
                    this.$router.push(`/persons/${this.personId}`);
                })
                .catch(error => {
                    console.error('Erro ao salvar o endereço:', error);
                });
        }
    }
};
</script>
