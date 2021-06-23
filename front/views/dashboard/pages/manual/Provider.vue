<template>
  <v-container id="manual_provider_dashboard" fluid tag="section">
    <v-row>
      <v-col cols="12">
        <crud-table
          title="Список поставищков"
          url-api="/providers"
          icon="mdi-account-star"
          :headers="headers"
          is-crud
          isCheckPass
        >
        </crud-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>



export default {
  name: "manual_provider_dashboard",
  
  data() {
    return {
      headers: [
        { text: "Название", value: "name" },
        { text: "Действия", value: "actions", edited: false },
      ],
    };
  },
  mounted() {},
  methods: {},
};
</script>