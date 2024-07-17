<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card class="mx-auto" max-width="900">
                    <v-card-title>
                        <h1>Endereços Antigos</h1>
                    </v-card-title>
                    <v-card-text>
                        <div v-if="isFetching">
                            <v-progress-circular indeterminate color="primary"></v-progress-circular>
                            <p>Carregando...</p>
                        </div>
                        <div v-else>
                            <v-list v-if="addresses.length">
                                <v-list-item v-for="address in addresses" :key="address.id">
                                    <v-list-item>
                                        <v-list-item-title>
                                            {{ address.type }}: {{ address.cep }}, {{ address.street }}, {{ address.number }}, {{ address.neighborhood }}, {{ address.city }} - {{ address.state }}
                                            <span v-if="address.deleted_at" class="red--text">(Removido)</span>
                                        </v-list-item-title>
                                    </v-list-item>
                                </v-list-item>
                            </v-list>
                            <p v-else>Nenhum endereço encontrado.</p>
                        </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="secondary" @click="$router.push({ name: 'PersonDetail', params: { id: personId } })">
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
            addresses: [],
            isFetching: false
        };
    },
    mounted() {
        this.isFetching = true;
        const personId = this.$route.params.id; // Assuming the person's ID is passed as a route parameter
        axios.get(`/api/addresses/all/${personId}?includeSoftDeleted=true`)
            .then(response => {
                this.addresses = response.data;
            })
            .catch(error => {
                console.error('Erro ao buscar endereços:', error);
            })
            .finally(() => {
                this.isFetching = false;
            });
    },
};
</script>
