<template>
  <v-container id="manual_stack_dashboard" fluid tag="section">
    <v-row>
      <v-col cols="12">
        <crud-table
          title="Список штабелей"
          url-api="/stacks"
          icon="mdi-stack-overflow"
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
  name: "manual_stack_dashboard",
  
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