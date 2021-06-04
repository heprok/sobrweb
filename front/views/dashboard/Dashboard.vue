<template>
  <v-container id="dashboard" fluid tag="section">
    <v-row>
      <v-col
        cols="12"
        sm="6"
        lg="3"
        v-for="infoCard in infoCards"
        :key="infoCard.nameCard"
      >
        <InfoCard
          :color="infoCard.color"
          :icon="infoCard.icon"
          :sub-icon="infoCard.subIcon"
          :title="infoCard.nameCard"
          :subText="infoCard.subTitle"
          :urlApi="infoCard.urlApi"
          :durations="infoCard.duration"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ChartCard from "../../components/charts/ChartCard";
export default {
  name: "DashboardDashboard",
  components: { ChartCard },
  data() {
    return {
      loader: false,
      infoCards: [
        {
          nameCard: "Текущая смена",
          color: "info",
          subIcon: "mdi-tag",
          icon: "mdi-account-hard-hat",
          urlApi: "/infocard/currentShift",
        },
        {
          nameCard: "Последний простой",
          color: "orange",
          icon: "mdi-clock-fast",
          subIcon: "mdi-camera-timer",
          urlApi: "/infocard/lastDowntime",
        },
        // {
        //   nameCard: "Кол-во карманов",
        //   subTitle: "ПФМ: Выгруженно карманов",
        //   color: "info",
        //   icon: "mdi-gradient",
        //   subIcon: "mdi-tag",
        //   urlApi: "/infocard/pfm/countUnloadPocket",
        //   duration: [
        //     {
        //       url: "/currentShift",
        //       title: "за смену",
        //     },
        //     {
        //       url: "/today",
        //       title: "за сутки",
        //     },
        //     {
        //       url: "/weekly",
        //       title: "за неделю",
        //     },
        //     {
        //       url: "/mountly",
        //       title: "за месяц",
        //     },
        //   ],
        // },
      ],
    };
  },
  mounted() {},
  methods: {
    complete(index) {
      this.list[index] = !this.list[index];
    },
  },
};
</script>
