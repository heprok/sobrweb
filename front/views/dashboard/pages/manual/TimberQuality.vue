<template>
  <v-container id="manual_timber_qualities_dashboard" fluid tag="section">
    <v-row>
      <v-col cols="12">
        <crud-table
          title="Список качеств"
          url-api="/timber_qualities"
          icon="mdi-quality-high"
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
  name: "manual_timber_qualities_dashboard",
  
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