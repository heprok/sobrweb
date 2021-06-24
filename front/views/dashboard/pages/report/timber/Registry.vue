<template>
  <v-container id="report_timber_registry_dashboard" fluid tag="section">
    <v-row>
      <v-col cols="12">
        <shift-date-picker
          isShowBatch
          :filterSqlWhere="filters"
          urlReport="report/timber/registry"
        >
        </shift-date-picker>
      </v-col>
      <v-col cols="12">
        <crud-table
          title="Брёвна за сегодняшний день"
          url-api="/timbers"
          :query="query"
          icon="mdi-gesture-double-tap"
          :headers="headers"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "report_timber_registry_dashboard",
  data() {
    return {
      filters: [],
      headers: [
        { text: "Время записи", value: "startTime" },
        { text: "Порода", value: "species.name" },
        { text: "Качество бревна", value: "quality" },
        { text: "Диаметр вершины, мм", value: "top_diam" },
        { text: "Диаметр центра, мм", value: "mid_diam" },
        { text: "Диаметр комля, мм", value: "butt_diam" },
        { text: "Овальность", value: "ovality" },
        { text: "Длина бревна, мм.", value: "length" },
        { text: "Сбег вершины, см/м", value: "top_taper" },
        { text: "Сбег комля, см/м", value: "butt_taper" },
        { text: "Сбег, см/м", value: "taper" },
        { text: "Кривизна,, см/м", value: "sweep" },
        { text: "Партия", value: "batch.id" },
      ],
    };
  },
  methods: {},
  computed: {
    query() {
      let periodDay = this.$store.getters.TIME_FOR_THE_DAY(this.date);

      return { drecTimestampKey: periodDay.start + "..." + periodDay.end };
    },
  },
};
</script>